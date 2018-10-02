<?php

namespace App\Models;

use App\Models\Currency;
use App\Models\Fields\Enum;
use App\Models\Fields\EnumCompetitionDuration;
use App\Models\Fields\EnumCompetitionStatus;
use App\Models\Formatters\Formatter;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model implements EnumCompetitionStatus, EnumCompetitionDuration
{
    use Enum, Formatter;

    protected $guarded = ['id'];

    // hide these fields from JSON output
    protected $hidden = ['user_id', 'status', 'created_at', 'updated_at'];

    /**
     * Auto-cast the following columns to Carbon
     *
     * @var array
     */
    protected $dates = ['start_time', 'end_time'];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'lot_size'          => 'integer',
        'leverage'          => 'integer',
        'start_balance'     => 'float',
        'volume_min'        => 'float',
        'volume_max'        => 'float',
        'min_margin_level'  => 'float',
        'fee'               => 'float',
    ];

    protected $formats = [
        'lot_size'          => 'integer',
        'leverage'          => 'integer',
        'start_balance'     => 'decimal',
        'volume_min'        => 'decimal',
        'volume_max'        => 'decimal',
        'min_margin_level'  => 'percentage',
        'fee'               => 'decimal',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function participants() {
        return $this->hasMany(CompetitionParticipant::class);
    }

    public function participantsWithUser() {
        return $this->participants()->with('user');
    }

    public function participant(User $user) {
        return $this->participants()->where('user_id', $user->id)->first();
    }

    public function trades() {
        return $this->hasMany(Trade::class);
    }

    public function openTrades() {
        return $this->trades()->where('status', Trade::STATUS_OPEN);
    }

    public function closedTrades() {
        return $this->trades()->where('status', Trade::STATUS_CLOSED);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Accessor for payouts property
     */
    public function getPayoutsAttribute() {
        return $this->payout_structure ? unserialize($this->payout_structure) : [];
    }
}