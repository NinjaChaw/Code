<?php

namespace App\Models;

use App\Models\Fields\EnumUserPointType;
use App\Models\Formatters\Formatter;
use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model implements EnumUserPointType
{
    use Formatter;

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'points' => 'integer',
    ];

    protected $formats = [
        'points' => 'integer',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
