<?php

namespace App\Models;

use App\Models\Currency;
use App\Models\Fields\Enum;
use App\Models\Fields\EnumTradeDirection;
use App\Models\Fields\EnumTradeStatus;
use App\Models\Formatters\Formatter;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model implements EnumTradeDirection, EnumTradeStatus
{
    use Enum, Formatter;

    // virtual model property, needs to be defined, so it's not saved to the database when save() method is called.
    public $unrealizedPnl;

    // hide these fields from JSON output
    protected $hidden = ['competition_id','user_id','asset_id','status','updated_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'price_open'    => 'float',
        'price_close'   => 'float',
        'lot_size'      => 'integer',
        'volume'        => 'float',
        'margin'        => 'float',
        'pnl'           => 'float',
    ];

    protected $formats = [
        'lot_size'          => 'integer',
        'volume'            => 'decimal',
        'price_open'        => 'variableDecimal',
        'price_close'       => 'variableDecimal',
        'margin'            => 'decimal',
        'pnl'               => 'decimal',
    ];

    /**
     * Auto-cast the following columns to Carbon
     *
     * @var array
     */
    protected $dates = ['closed_at'];

    protected $appends = ['direction_sign'];

    public function competition() {
        return $this->belongsTo(Competition::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function asset() {
        return $this->belongsTo(Asset::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function getDirectionSignAttribute() {
        return $this->direction == self::DIRECTION_BUY ? 1 : -1;
    }
}
