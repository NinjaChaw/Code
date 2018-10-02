<?php

namespace App\Models\Sort\Backend;

use App\Models\Sort\Sort;

class CompetitionSort extends Sort
{
    protected $sortableColumns = [
        'id'                => 'id',
        'title'             => 'title',
        'balance'           => 'start_balance',
        'duration'          => 'duration',
        'start_time'        => 'start_time',
        'end_time'          => 'end_time',
        'slots'             => 'slots_taken',
        'status'            => 'status',
        'created'           => 'created_at',
    ];
}