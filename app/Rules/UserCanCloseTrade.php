<?php

namespace App\Rules;

use App\Models\Competition;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserCanCloseTrade implements Rule
{
    private $trade;
    private $competition;
    private $user;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Trade $trade, Competition $competition, User $user)
    {
        $this->trade = $trade;
        $this->competition = $competition;
        $this->user = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->trade->competition_id == $this->competition->id
            && $this->trade->user_id == $this->user->id
            && $this->trade->status == Trade::STATUS_OPEN;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('app.can_not_close_trade');
    }
}
