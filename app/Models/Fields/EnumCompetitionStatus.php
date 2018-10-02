<?php

namespace App\Models\Fields;

interface EnumCompetitionStatus {
    const STATUS_OPEN           = 0;
    const STATUS_IN_PROGRESS    = 1;
    const STATUS_COMPLETED      = 2;
    const STATUS_CANCELLED      = 3;
}