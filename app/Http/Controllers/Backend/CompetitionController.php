<?php

namespace App\Http\Controllers\Backend;

use App\Models\Currency;
use App\Http\Requests\Backend\StoreCompetition;
use App\Http\Requests\Backend\UpdateCompetition;
use App\Models\Competition;
use App\Models\Sort\Backend\CompetitionSort;
use App\Rules\CompetitionIsEditable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Competition $competition
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Competition $competition)
    {
        $sort = new CompetitionSort($request);

        $competitions = Competition::orderBy($sort->getSortColumn(), $sort->getOrder())
            ->with('currency')
            ->paginate($this->rowsPerPage);

        return view('pages.backend.competitions.index', [
            'competitions'  => $competitions,
            'sort'          => $sort->getSort(),
            'order'         => $sort->getOrder(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.competitions.create', ['durations' => Competition::getEnumValues('CompetitionDuration')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompetition $request)
    {
        // get default currency
        $currency = Currency::where('code', config('settings.currency'))->first();

        // validator passed, create competition
        $competition = new Competition();
        $competition->title = $request->title;
        $competition->duration = $request->duration;
        $competition->slots_required = $request->slots_required;
        $competition->slots_max = $request->slots_max;
        $competition->start_balance = $request->start_balance;
        $competition->lot_size = $request->lot_size;
        $competition->leverage = $request->leverage;
        $competition->volume_min = $request->volume_min;
        $competition->volume_max = $request->volume_max;
        $competition->min_margin_level = $request->min_margin_level;
        $competition->fee = $request->fee ?: 0;
        $competition->status = Competition::STATUS_OPEN;
        $competition->user()->associate($request->user());
        $competition->currency()->associate($currency);

        // save payout structure for paid competitions
        if ($competition->fee > 0 && is_array($request->payouts_amounts) && is_array($request->payouts_types)) {
            $payoutStructure = array_map(function($payout, $type) {
                return [
                    'amount'    => $payout,
                    'type'      => $type
                ];
            }, $request->payouts_amounts, $request->payouts_types);
            $competition->payout_structure = serialize($payoutStructure);
        }

        $competition->save();

        return redirect()
            ->route('backend.competitions.index')
            ->with('success', __('app.create_competition_success', ['title' => $competition->title]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Competition $competition)
    {
        $view = view('pages.backend.competitions.edit', [
            'competition'       => $competition,
            'payouts_amounts'   => array_column($competition->payouts, 'amount'),
            'payouts_types'     => array_column($competition->payouts, 'type'),
            'durations'         => Competition::getEnumValues('CompetitionDuration'),
            'editable'          => (new CompetitionIsEditable($competition))->passes()
        ]);

        // warn user if competition can not be edited
        if (!$view->editable)
            $request->session()->flash('warning', __('app.competition_edit_warning'));

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Backend\UpdateCompetition  $request
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompetition $request, Competition $competition)
    {
        $competition->title = $request->title;
//        $competition->duration = $request->duration;
        $competition->slots_required = $request->slots_required;
        $competition->slots_max = $request->slots_max;
        $competition->start_balance = $request->start_balance;
        $competition->lot_size = $request->lot_size;
        $competition->leverage = $request->leverage;
        $competition->volume_min = $request->volume_min;
        $competition->volume_max = $request->volume_max;
        $competition->min_margin_level = $request->min_margin_level;
        $competition->fee = $request->fee;
        $competition->status = $request->status;

        // save payout structure for paid competitions
        if ($competition->fee > 0 && is_array($request->payouts_amounts) && is_array($request->payouts_types)) {
            $payoutStructure = array_map(function($payout, $type) {
                return [
                    'amount'    => $payout,
                    'type'      => $type
                ];
            }, $request->payouts_amounts, $request->payouts_types);
            $competition->payout_structure = serialize($payoutStructure);
        } else {
            $competition->payout_structure = NULL;
        }

        $competition->save();

        return redirect()
            ->route('backend.competitions.index')
            ->with('success', __('app.competition_saved', ['name' => $competition->title]));
    }

    /**
     * Delete competition confirmation page
     *
     * @param Competition $competition
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(Request $request, Competition $competition) {
        $request->session()->flash('warning', __('app.competition_delete_warning'));
        return view('pages.backend.competitions.delete', ['competition' => $competition]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $competitionTitle = $competition->title;
        $competition->delete();

        return redirect()
            ->route('backend.competitions.index')
            ->with('success', __('app.competition_deleted', ['name' => $competitionTitle]));
    }
}