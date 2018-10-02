<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\UpdateUser;
use App\Models\Sort\Backend\UserSort;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, User $user)
    {
        $sort = new UserSort($request);

        $users = User::orderBy($sort->getSortColumn(), $sort->getOrder())
            ->with('profiles')
            ->paginate($this->rowsPerPage);

        return view('pages.backend.users.index', [
            'users'     => $users,
            'sort'      => $sort->getSort(),
            'order'     => $sort->getOrder(),
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        return view('pages.backend.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.backend.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        // validator passed, update fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;

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
        } else if ($user->avatar) {
            Storage::delete('avatars/' . $user->avatar);
            $user->avatar = NULL;
        }

        // update password if it was filled in
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()
            ->route('backend.users.index')
            ->with('success', __('users.saved', ['name' => $user->name]));
    }

    /**
     * Display a page to confirm deleting a user
     *
     * @param  \App\Models\User  $user
     */
    public function delete(Request $request, User $user) {
        // check that the user being deleted is not current
        if ($request->user()->id == $user->id) {
            return redirect()
                ->back()
                ->withErrors(['user' => __('users.error_delete_self')]);
        }

        $request->session()->flash('warning', __('users.delete_warning'));
        return view('pages.backend.users.delete', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request$request, User $user)
    {
        // check that the user being deleted is not current
        if ($request->user()->id == $user->id) {
            return redirect()
                ->back()
                ->withErrors(['user' => __('users.error_delete_self')]);
        }

        $userName = $user->name;

        // delete avatar
        if ($user->avatar)
            Storage::delete('avatars/' . $user->avatar);

        // delete user
        $user->delete();

        return redirect()
            ->route('backend.users.index')
            ->with('success', __('users.deleted', ['name' => $userName]));
    }
}