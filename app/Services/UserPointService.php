<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserPoint;

class UserPointService
{
    /**
     * Add points
     *
     * @param User $user
     * @param $type
     * @param $points
     * @return UserPoint|null
     */
    public function add(User $user, $type, $points) {
        if ($points > 0) {
            $userPoint = new UserPoint();
            $userPoint->user()->associate($user);
            $userPoint->type = $type;
            $userPoint->points = $points;
            $userPoint->save();
            return $userPoint;
        }

        return NULL;
    }
}