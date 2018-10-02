<?php

namespace App\Models\Sort\Frontend;

use App\Models\Sort\Sort;

class CompetitionTradeSort extends Sort
{
    protected $sortableColumns = [
        'asset'             => 'assets.symbol',
        'direction'         => 'direction',
        'volume'            => 'volume',
        'price_open'        => 'price_open',
        'price_close'       => 'price_close',
        'pnl'               => 'pnl',
        'created'           => 'trades.created_at',
        'closed'            => 'closed_at'
    ];

    protected $defaultSort = 'closed';
}