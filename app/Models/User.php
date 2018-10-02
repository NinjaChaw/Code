<?php

namespace App\Models;

use App\Notifications\MailResetPasswordToken;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Fields\Enum;
use App\Models\Fields\EnumUserRole;
use App\Models\Fields\EnumUserStatus;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable implements EnumUserRole, EnumUserStatus
{
    use Notifiable {
        notify as protected _notify;
    }

    use Enum;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role', 'status', 'password', 'last_login_time', 'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'email','password', 'remember_token','role','status','last_login_time','last_login_ip','created_at','updated_at'
    ];

    /**
     * Auto-cast the following columns to Carbon
     *
     * @var array
     */
    protected $dates = ['last_login_time'];

    /**
     * The accessors to append to the model's array form (selected fields will be automatically added to JSON).
     *
     * @var array
     */
    protected $appends = ['avatar_url'];

    /**
     * Custom accessor for avatar URL
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return config('settings.image_url_generation') == 'storage'
                ? asset('storage/avatars/' . $this->avatar)
                : route('assets.image', ['avatars', $this->avatar]);
        } else {
            return asset('images/avatar.jpg');
        }
    }

    /**
     * Get user rank
     * @return mixed
     */
    public function getRankAttribute() {
        // check if ranks exist in cache
        /*if (!$userRanks = Cache::get('ranks')) {
            $userRanks = User::selectRaw('users.id, SUM(points) AS points')
                ->where('status', User::STATUS_ACTIVE)
                ->leftJoin('user_points', 'user_points.user_id', '=', 'users.id')
                ->groupBy('users.id')
                ->orderBy('points', 'desc')
                ->orderBy('id', 'asc')
                ->get()
                ->mapWithKeys(function ($row, $key) {
                    return [$row['id'] => $key+1];
                })
                ->toArray();

            // store ranks in cache
            Cache::put('ranks', $userRanks, now()->addMinutes(config('app.cache_time_ranks')));
        }*/

        $userRanks = User::selectRaw('users.id, SUM(points) AS points')
            ->where('status', User::STATUS_ACTIVE)
            ->leftJoin('user_points', 'user_points.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->orderBy('points', 'desc')
            ->orderBy('id', 'asc')
            ->get()
            ->mapWithKeys(function ($row, $key) {
                return [$row['id'] => $key+1];
            })
            ->toArray();

        return $userRanks[$this->id];
    }

    public function points() {
        return $this->hasMany(UserPoint::class);
    }

    public function trades() {
        return $this->hasMany(Trade::class);
    }

    public function profiles(){
        return $this->hasMany(SocialProfile::class);
    }

    public function openTrades() {
        return $this->trades()->where('trades.status', Trade::STATUS_OPEN);
    }

    public function closedTrades() {
        return $this->trades()->where('trades.status', Trade::STATUS_CLOSED);
    }

    public function lastTrades($limit) {
        return $this->trades()->with('asset', 'currency')->orderBy('trades.id', 'desc')->limit($limit);
    }

    /**
     * Get roles
     *
     * @return array
     */
    public static function getRoles() {
        return self::getEnumValues('UserRole');
    }

    /**
     * Get statuses
     *
     * @return array
     */
    public static function getStatuses() {
        return self::getEnumValues('UserStatus');
    }

    /**
     * Check if user has given role
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role) {
        return isset($this->role) && $this->role == $role;
    }

    /**
     * check if user is admin
     */
    public function admin() {
        return $this->hasRole(User::ROLE_ADMIN);
    }

    /**
     * Send password reset link to user (overridden)
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    /**
     * Override default notify method and catch all possible transport exceptions
     *
     * @param $instance
     * @throws \Swift_TransportException
     */
    public function notify($instance) {
        try {
            // call original notify method from RoutesNotifications trait
            $this->_notify($instance);
        } catch (\Swift_TransportException $e) {
            Log::error('Swift_TransportException: ' . $e->getMessage());
            // if debug is disabled
            if (!config('app.debug')) {
                // if the app is not called from console simply show a form submit error instead of 500 server error
                if (!App::runningInConsole()) {
                    request()->session()->forget('status');
                    back()
                        ->withInput(request()->only('email'))
                        ->withErrors(['server' => __('email.error')]);
                }
            } else {
                throw $e;
            }
        }
    }
}
