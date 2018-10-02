<?php

namespace App\Http\Controllers\Frontend;

use App\Badge;
use App\Models\User;
use App\Http\Controllers\Controller;

class RankingController extends Controller
{
    public function index() {
        $users = User::selectRaw('users.id, name, avatar, IFNULL(SUM(points),0) AS points')
            ->where('status', User::STATUS_ACTIVE)
            ->leftJoin('user_points', 'user_points.user_id', '=', 'users.id')
            ->with('closedTrades')
            ->groupBy('users.id','name','avatar')
            ->orderBy('points', 'desc')
            ->orderBy('id', 'asc')
            ->paginate($this->rowsPerPage);

        $badges = Badge::orderBy('points', 'desc')->get();

        return view('pages.frontend.rankings', [
            'users'   => $users,
            'badges'  => $badges,
        ]);
    }
}
