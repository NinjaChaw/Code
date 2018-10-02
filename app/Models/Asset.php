<?php

namespace App\Models;

use App\Models\Fields\Enum;
use App\Models\Fields\EnumAssetStatus;
use App\Models\Formatters\Formatter;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model implements EnumAssetStatus
{
    use Enum, Formatter;

    protected $hidden = ['type','status','created_at','updated_at'];

    /**
     * The accessors to append to the model's array form (selected fields will be automatically added to JSON).
     *
     * @var array
     */
    protected $appends = ['logo_url', 'title'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'price'             => 'float',
        'change_abs'        => 'float',
        'change_pct'        => 'float',
        'supply'            => 'float', // should be float to properly handle bigint datatype
        'volume'            => 'float', // should be float to properly handle bigint datatype
        'market_cap'        => 'float', // should be float to properly handle bigint datatype
    ];

    protected $formats = [
        'price'             => 'variableDecimal',
        'change_abs'        => 'variableDecimal',
        'change_pct'        => 'decimal',
        'supply'            => 'integer',
        'volume'            => 'integer',
        'market_cap'        => 'integer',
        'trades_count'      => 'integer',
    ];

    /**
     * Accessor for asset logo URL
     *
     * @return string
     */
    public function getLogoUrlAttribute()
    {
        return $this->logo
            ? (config('settings.image_url_generation') == 'storage'
                ? asset('storage/assets/' . $this->logo)
                : route('assets.image', ['assets', $this->logo]))
            : asset('images/asset.png');
    }

    /**
     * Accessor for title property
     *
     * @return string
     */
    public function getTitleAttribute() {
        return $this->symbol;
    }

    /**
     * Get asset statuses
     *
     * @return array
     */
    public static function getStatuses() {
        return self::getEnumValues('AssetStatus');
    }

    public function trades() {
        return $this->hasMany(Trade::class);
    }
}
