<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        // run middleware to see if logged in user can edit the requested user
        $this->middleware('self')->only(['edit','update']);
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $trades = $user->closedTrades()->get();
        $tradesCount = $trades->count();

        $profitableTradesCount = $trades->filter(function ($trade) {
                return $trade->pnl > 0;
            })
            ->count();

        $unprofitableTradesCount = $trades->filter(function ($trade) {
                return $trade->pnl <= 0;
            })
            ->count();

        $recentTrades = $user->lastTrades(10)->get();

        return view('pages.frontend.users.show', [
            'user'                          => $user,
            'trades_count'                  => $tradesCount,
            'profitable_trades_count'       => $profitableTradesCount,
            'unprofitable_trades_count'     => $unprofitableTradesCount,
            'recent_trades'                 => $recentTrades,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        return view('pages.frontend.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        // validator passed, update fields
        $user->name = $request->name;
        $user->email = $request->email;

        // avatar is uploaded or updated
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarFileName = $user->id . '_' . time() . '.' . $avatar->getClientOriginalExtension();
            // resize image to 300px max height
            $avatarContents = (string) Image::make($avatar)
                ->resize(null, config('settings.user_avatar_height'), function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode();

            // store avatar
            if (Storage::put('avatars/' . $avatarFileName, $avatarContents)) {
                // delete previous avatar
                if ($user->avatar)
                    Storage::delete('avatars/' . $user->avatar);
                // set uploaded avatar
                $user->avatar = $avatarFileName;
            }
        // avatar is deleted
        } else if ($request->deleted === 'true' && $user->avatar) {
            Storage::delete('avatars/' . $user->avatar);
            $user->avatar = NULL;
        }

        $user->save();

        return redirect()
            ->route('frontend.users.show', $user)
            ->with('success', __('users.saved', ['name' => $user->name]));
    }
}
