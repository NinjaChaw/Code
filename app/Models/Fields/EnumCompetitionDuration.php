<?php

namespace App\Models\Fields;

interface EnumCompetitionDuration {
    const DURATION_30MIN        = 'PT30M';
    const DURATION_1H           = 'PT1H';
    const DURATION_2H           = 'PT2H';
    const DURATION_4H           = 'PT4H';
    const DURATION_8H           = 'PT8H';
    const DURATION_24H          = 'PT24H';
    const DURATION_2D           = 'P2D';
    const DURATION_3D           = 'P3D';
    const DURATION_4D           = 'P4D';
    const DURATION_5D           = 'P5D';
    const DURATION_6D           = 'P6D';
    const DURATION_1W           = 'P1W';
    const DURATION_2W           = 'P2W';
    const DURATION_3W           = 'P3W';
    const DURATION_4W           = 'P4W';
    const DURATION_1M           = 'P1M';
    const DURATION_2M           = 'P2M';
    const DURATION_3M           = 'P3M';
    const DURATION_6M           = 'P6M';
    const DURATION_1Y           = 'P1Y';
    const DURATION_2Y           = 'P2Y';
    const DURATION_5Y           = 'P5Y';
}