<?php

namespace App\Models\Sort\Frontend;

use App\Models\Sort\Sort;

class AssetSort extends Sort
{
    protected $sortableColumns = [
        'symbol'            => 'symbol',
        'name'              => 'name',
        'price'             => 'price',
        'change_abs'        => 'change_abs',
        'change_pct'        => 'change_pct',
        'market_cap'        => 'market_cap',
        'trades_count'      => 'trades_count',
    ];

    protected $defaultSort = 'market_cap';
}