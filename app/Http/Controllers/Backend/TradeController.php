<?php

namespace App\Http\Controllers\Backend;

use App\Models\Sort\Backend\TradeSort;
use App\Models\Trade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = new TradeSort($request);

        $trades = Trade::select('trades.*')
            ->join('competitions', 'trades.competition_id', '=', 'competitions.id')
            ->join('assets', 'trades.asset_id', '=', 'assets.id')
            ->with('competition','asset')
            ->orderBy($sort->getSortColumn(), $sort->getOrder())
            ->paginate($this->rowsPerPage);

        return view('pages.backend.trades.index', [
            'trades'    => $trades,
            'sort'      => $sort->getSort(),
            'order'     => $sort->getOrder(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Trade $trade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Trade $trade)
    {
        return view('pages.backend.trades.edit', [
            'trade' => $trade
        ]);
    }
}
