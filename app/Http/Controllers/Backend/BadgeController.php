<?php

namespace App\Http\Controllers\Backend;

use App\Badge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badges = Badge::all();

        return view('pages.backend.badges.index', ['badges' => $badges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.backend.badges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'logo' => 'required',
            'label' => 'required',
            'points' => 'required',
        ]);

        $badge = new Badge();

        $logo = $request->file('logo');
        $logoName = time().'.'.$logo->getClientOriginalName();
        $logo->move(public_path('/images/badges'), $logoName);
        $badge->avatar = $logoName;

        $badge->title = $request->label;
        $badge->points = $request->points;

        $badge->save();

        Session::flash('success', 'Badge created successfully.');

        Return redirect()->route('backend.badge.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $badge = Badge::findOrFail($id);

        return view('pages.backend.badges.edit', ['badge' => $badge]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'logo' => 'required',
            'label' => 'required',
            'points' => 'required',
        ]);

        $badge = Badge::find($id);

        unlink('images/badges/'.$badge->avatar);

        $logo = $request->file('logo');
        $logoName = time().'.'.$logo->getClientOriginalName();
        $logo->move(public_path('/images/badges'), $logoName);
        $badge->avatar = $logoName;

        $badge->title = $request->label;
        $badge->points = $request->points;

        $badge->save();

        Session::flash('success', 'Badge updated successfully.');

        Return redirect()->route('backend.badge.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
