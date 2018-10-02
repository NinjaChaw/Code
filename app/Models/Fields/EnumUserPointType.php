<?php

namespace App\Models\Fields;

interface EnumUserPointType {
    const TYPE_TRADE_LOSS               = 1;
    const TYPE_TRADE_PROFIT             = 2;
    const TYPE_COMPETITION_JOIN         = 3;
    const TYPE_COMPETITION_PLACE1       = 4;
    const TYPE_COMPETITION_PLACE2       = 5;
    const TYPE_COMPETITION_PLACE3       = 6;
}