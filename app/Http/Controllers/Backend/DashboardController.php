<?php

namespace App\Http\Controllers\Backend;

use App\Models\Competition;
use App\Models\Trade;
use App\Models\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        $usersCount = User::count();
        $activeUsersCount = User::where('status', User::STATUS_ACTIVE)->count();
        $blockedUsersCount = User::where('status', User::STATUS_BLOCKED)->count();

        $competitionsCount = Competition::count();
        $openCompetitionsCount = Competition::where('status', Competition::STATUS_OPEN)->orWhere('status', Competition::STATUS_IN_PROGRESS)->count();
        $closedCompetitionsCount = Competition::where('status', Competition::STATUS_COMPLETED)->orWhere('status', Competition::STATUS_CANCELLED)->count();

        $tradesCount = Trade::where('status', Trade::STATUS_CLOSED)->count();
        $profitableTradesCount = Trade::where('status', Trade::STATUS_CLOSED)->where('pnl', '>', 0)->count();
        $unprofitableTradesCount = Trade::where('status', Trade::STATUS_CLOSED)->where('pnl', '<=', 0)->count();

        return view('pages.backend.dashboard', [
            'users_count'                   => $usersCount,
            'active_users_count'            => $activeUsersCount,
            'blocked_users_count'           => $blockedUsersCount,

            'competitions_count'            => $competitionsCount,
            'open_competitions_count'       => $openCompetitionsCount,
            'closed_competitions_count'     => $closedCompetitionsCount,

            'trades_count'                  => $tradesCount,
            'profitable_trades_count'       => $profitableTradesCount,
            'unprofitable_trades_count'     => $unprofitableTradesCount,
        ]);
    }
}
