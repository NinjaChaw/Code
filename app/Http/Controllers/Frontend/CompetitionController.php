<?php

namespace App\Http\Controllers\Frontend;

use App\Badge;
use App\Events\AfterUserJoinedCompetition;
use App\Events\BeforeUserJoinedCompetition;
use App\Http\Requests\Frontend\CloseTrade;
use App\Http\Requests\Frontend\JoinCompetition;
use App\Http\Requests\Frontend\OpenTrade;
use App\Models\Asset;
use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\Sort\Frontend\CompetitionSort;
use App\Models\Sort\Frontend\CompetitionTradeSort;
use App\Models\Trade;
use App\Services\TradeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class CompetitionController extends Controller
{
    private $competitionModel;

    public function __construct(Competition $competition)
    {
        // save Competition model as a property and use it later in the controller methods,
        // so that other packages can bind their own implementations via IoC
        // If used directly (e.g. $c = Competition::where(...)->get()) bindings will not work and overridden model will not be used.
        $this->competitionModel = $competition;
    }

    public function index(Request $request)
    {
        $sort = new CompetitionSort($request);

        $competitions = $this->competitionModel::where('status', '!=', Competition::STATUS_CANCELLED)
            ->with('currency')
            ->withCount(['participants as is_participant' => function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            }])
            ->orderBy($sort->getSortColumn(), $sort->getOrder())
            ->paginate($this->rowsPerPage);

        $badges = Badge::orderBy('points', 'desc')->get();

        return view('pages.frontend.competitions.index', [
            'competitions'  => $competitions,
            'sort'          => $sort->getSort(),
            'order'         => $sort->getOrder(),
            'badges'        => $badges,
        ]);
    }

    public function show(Request $request, Competition $competition)
    {
        $competitionParticipant = $competition->participant($request->user());
        $redirect = $this->checkAccessOrRedirect($request, $competition, $competitionParticipant);
        if ($redirect)
            return $redirect;

        $defaultAssetId = $request->session()->get('default_asset_id');
        if ($defaultAssetId) {
            $asset = Asset::find($defaultAssetId);
        } else {
            $asset = Asset::where('status', Asset::STATUS_ACTIVE)->where('price', '>', 0)->inRandomOrder()->first();
        }

        return view('pages.frontend.competitions.show', [
            'competition'           => $competition,
            'participant'           => $competitionParticipant,
            'asset'                 => $asset,
        ]);
    }

    public function leaderboard(Request $request, Competition $competition)
    {
        $competitionParticipant = $competition->participant($request->user());
        $redirect = $this->checkAccessOrRedirect($request, $competition, $competitionParticipant);
        if ($redirect)
            return $redirect;

        $leaderboard = CompetitionParticipant::selectRaw('competition_participants.user_id, place, start_balance, current_balance, COUNT(trades.id) AS trades_count, IF(MIN(trades.pnl)<0,MIN(trades.pnl),NULL) AS max_loss, IF(MAX(trades.pnl)>0,MAX(trades.pnl),NULL) AS max_profit')
            ->where('competition_participants.competition_id', $competition->id)
            ->leftJoin('trades', function($join) {
                $join->on('competition_participants.user_id', '=', 'trades.user_id');
                $join->on('competition_participants.competition_id', '=', 'trades.competition_id');
            })
            ->leftJoin('users', 'competition_participants.user_id', '=', 'users.id')
            ->groupBy('competition_participants.id', 'competition_participants.user_id', 'place', 'start_balance', 'current_balance')
            ->orderBy('place', 'asc')
            ->orderBy('current_balance', 'desc')
            ->orderBy('competition_participants.id')
            ->with('user')
            ->paginate($this->rowsPerPage);

        return view('pages.frontend.competitions.leaderboard', [
            'competition'   => $competition,
            'participant'   => $competitionParticipant,
            'leaderboard'   => $leaderboard,
        ]);
    }

    public function history(Request $request, Competition $competition) {
        $competitionParticipant = $competition->participant($request->user());
        $redirect = $this->checkAccessOrRedirect($request, $competition, $competitionParticipant);
        if ($redirect)
            return $redirect;

        $sort = new CompetitionTradeSort($request);

        $trades = Trade::select('trades.asset_id','trades.direction','trades.volume','trades.price_open','trades.price_close','trades.pnl','trades.created_at','trades.closed_at')
            ->join('assets', 'assets.id', '=', 'trades.asset_id')
            ->where([
                ['competition_id', $competition->id],
                ['user_id', $request->user()->id],
                ['trades.status', Trade::STATUS_CLOSED]
            ])
            ->with('asset:id,symbol,name,logo')
            ->orderBy($sort->getSortColumn(), $sort->getOrder())
            ->paginate($this->rowsPerPage);

        return view('pages.frontend.competitions.history', [
            'competition'   => $competition,
            'participant'   => $competitionParticipant,
            'trades'        => $trades,
            'sort'          => $sort->getSort(),
            'order'         => $sort->getOrder(),
        ]);
    }

    public function join(JoinCompetition $request, Competition $competition) {

        event(new BeforeUserJoinedCompetition($competition, $request->user()));

        // create participant
        $participant = new CompetitionParticipant();
        $participant->competition()->associate($competition);
        $participant->user()->associate($request->user());
        $participant->start_balance = $competition->start_balance;
        $participant->current_balance = $competition->start_balance;
        $participant->save();

        // update competition
        $updateTimestamp = FALSE;
        $competition->slots_taken++;
        // minimum number of participants joined => start competition
        if ($competition->slots_taken >= $competition->slots_required && !$competition->start_time && !$competition->end_time && $competition->status != Competition::STATUS_IN_PROGRESS) {
            $now = Carbon::now();
            $durationInterval = new \DateInterval($competition->duration);
            $competition->start_time = $now;
            $competition->end_time = $now->add($durationInterval);
            $competition->status = Competition::STATUS_IN_PROGRESS;
            $updateTimestamp = TRUE;
        }

        $competition->save(['timestamps' => $updateTimestamp]);

        event(new AfterUserJoinedCompetition($competition, $request->user()));

        return back()->with('success', __('app.competition_join_success', ['title' => $competition->title]));
    }

    /**
     * Save a new trade
     *
     * @param Request $request
     * @param Competition $competition
     */
    public function openTrade(OpenTrade $request, Competition $competition, Asset $asset) {
        $tradeService = new TradeService($competition, $request->user());
        return $tradeService->open($asset, $request->direction, $request->volume);
    }


    /**
     * Close an open trade
     *
     * @param CloseTrade $request
     * @param Competition $competition
     * @return array
     */
    public function closeTrade(CloseTrade $request, Competition $competition, Trade $trade) {
        $tradeService = new TradeService($competition, $request->user());
        return $tradeService->close($trade);
    }

    public function trades(Request $request, Competition $competition) {
        return Trade::where([
                ['competition_id', $competition->id],
                ['user_id', $request->user()->id],
                ['status', Trade::STATUS_OPEN]
            ])
            ->with('asset:id,symbol,name,price,logo')
            ->with('competition:id,leverage')
            ->latest()
            ->get();
    }

    public function participants(Competition $competition) {
        return $competition
            ->participants()
            ->with('user')
            ->orderBy('place', 'asc')
            ->orderBy('current_balance', 'desc')
            ->orderBy('id', 'asc')
            ->get();
    }

    private function checkAccessOrRedirect(Request $request, Competition $competition, $competitionParticipant)
    {
        $route = $request->route()->getName();

        if (in_array($competition->status, [Competition::STATUS_OPEN, Competition::STATUS_CANCELLED])) {
            return redirect()->route('frontend.competitions.index')->with('warning', trans_choice('app.competition_waiting_participants', $competition->slots_required - $competition->slots_taken, ['n' => $competition->slots_required - $competition->slots_taken]));
        // check if user participates in the competition, public access allowed only to the leaderboard tab when competition is closed
        } elseif (!$competitionParticipant && $route != 'frontend.competitions.leaderboard') {
            return redirect()->route('frontend.competitions.leaderboard', $competition);
        } elseif ($competition->status == Competition::STATUS_COMPLETED && $route == 'frontend.competitions.show') {
            return redirect()->route('frontend.competitions.leaderboard', $competition);
        }

        return NULL;
    }
}
