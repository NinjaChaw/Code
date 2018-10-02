<?php

namespace App\Services;

use App\Events\AfterCompetitionClosed;
use App\Models\Competition;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CompetitionExpiryService
{
    private $competitionModel;

    public function __construct(Competition $competition)
    {
        // save Competition model as a property and use it later in the controller methods,
        // so that other packages can bind their own implementations via IoC
        // If used directly (e.g. $c = Competition::where(...)->get()) bindings will not work and overridden model will not be used.
        $this->competitionModel = $competition;
    }

    public function run()
    {
        $competitions = $this->competitionModel::where('status', Competition::STATUS_IN_PROGRESS)
            ->where('end_time', '<', Carbon::now())
            ->get();

        foreach ($competitions as $competition) {
            Log::info(sprintf('Closing competition %d %s', $competition->id, $competition->title));

            // change competition status first, so no more trades can be made
            $competition->status = $this->competitionModel::STATUS_COMPLETED;
            $competition->save();

            // close all open trades
            foreach ($competition->participants()->with('user')->get() as $participant) {
                $tradeService = new TradeService($competition, $participant->user);
                $tradeService->closeAll();
                // set participant balance to 0 if no trades were made
                if ($tradeService->closedTradesCount() == 0) {
                    $participant->current_balance = 0;
                    $participant->save();
                }
            }

            // update participants standings in competition (important to retrieve them again from database)
            $competition->participants()->orderBy('current_balance', 'desc')->orderBy('id', 'asc')->get()->each(function ($participant, $i) {
                $participant->place = $i + 1;
                $participant->save();
                // award points to winners
                if (in_array($participant->place, [1,2,3])) {
                    $userPointService = new UserPointService();
                    $userPointService->add(
                        $participant->user,
                        constant('\App\Models\UserPoint::TYPE_COMPETITION_PLACE' . $participant->place),
                        config('settings.points_type_competition_place' . $participant->place)
                    );
                }
            });

            // trigger CompetitionClosed event
            event(new AfterCompetitionClosed($competition));
        }
    }
}