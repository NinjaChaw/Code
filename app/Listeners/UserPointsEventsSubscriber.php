<?php

namespace App\Listeners;

use App\Events\AfterTradeClosed;
use App\Events\AfterUserJoinedCompetition;
use App\Models\UserPoint;
use App\Services\UserPointService;

class UserPointsEventsSubscriber
{
    public function afterTradeClosed(AfterTradeClosed $event) {
        $trade = $event->trade();

        if ($trade->pnl > 0) {
            $type = UserPoint::TYPE_TRADE_PROFIT;
            $points = config('settings.points_type_trade_profit');
        } else {
            $type = UserPoint::TYPE_TRADE_LOSS;
            $points = config('settings.points_type_trade_loss');
        }

        $userPointService = new UserPointService();
        $userPointService->add($event->user(), $type, $points);
    }

    public function afterUserJoinedCompetition(AfterUserJoinedCompetition $event) {
        $userPointService = new UserPointService();
        $userPointService->add(
            $event->user(),
            UserPoint::TYPE_COMPETITION_JOIN,
            config('settings.points_type_competition_join')
        );
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            AfterTradeClosed::class,
            'App\Listeners\UserPointsEventsSubscriber@afterTradeClosed'
        );

        $events->listen(
            AfterUserJoinedCompetition::class,
            'App\Listeners\UserPointsEventsSubscriber@afterUserJoinedCompetition'
        );
    }
}