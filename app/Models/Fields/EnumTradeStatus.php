<?php

namespace App\Models\Fields;

interface EnumTradeStatus {
    const STATUS_OPEN       = 0;
    const STATUS_CLOSED     = 1;
    const STATUS_CANCELLED  = 2;
}