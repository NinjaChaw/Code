<?php

namespace App\Http\Controllers\Frontend;

use App\Badge;
use App\Models\Asset;
use App\Models\Competition;
use App\Http\Controllers\Controller;
use App\Models\Trade;

class DashboardController extends Controller
{
    public function index() {
        $myCompetitions = Competition::whereHas('participants', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->orderBy('end_time')
            ->get();

        $topTradedAssets = Asset::selectRaw('symbol, logo, COUNT(*) AS trades_count')
            ->where('assets.status', Asset::STATUS_ACTIVE)
            ->join('trades', 'assets.id', '=', 'trades.asset_id')
            ->groupBy('symbol','logo')
            ->orderBy('trades_count', 'desc')
            ->orderBy('symbol', 'asc')
            ->limit(6)
            ->get();

        $topTraders = Trade::selectRaw('user_id, COUNT(*) AS profitable_trades')
            ->where('status', Trade::STATUS_CLOSED)
            ->where('pnl', '>', 0)
            ->with('user')
            ->groupBy('user_id')
            ->orderBy('profitable_trades', 'desc')
            ->limit(6)
            ->get();

        $topTrades = Trade::where('status', Trade::STATUS_CLOSED)
            ->where('pnl', '>', 0)
            ->with('user', 'currency')
            ->orderBy('pnl', 'desc')
            ->limit(5)
            ->get();

        $badges = Badge::orderBy('points', 'desc')->get();

        return view('pages.frontend.dashboard', [
            'my_competitions'       => $myCompetitions,
            'top_traded_assets'     => $topTradedAssets,
            'top_traders'           => $topTraders,
            'top_trades'            => $topTrades,
            'badges'                 => $badges,
        ]);
    }
}
