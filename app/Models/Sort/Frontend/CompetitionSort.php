<?php

namespace App\Models\Sort\Frontend;

use App\Models\Sort\Sort;

class CompetitionSort extends Sort
{
    protected $sortableColumns = [
        'id'                => 'id',
        'title'             => 'title',
        'balance'           => 'start_balance',
        'duration'          => 'duration',
        'slots'             => 'slots_taken',
        'status'            => 'status',
        'created'           => 'created_at',
    ];
}