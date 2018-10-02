<?php

namespace App\Rules;

use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class UserCanJoinCompetition implements Rule
{
    private $competition;
    private $user;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Competition $competition, User $user)
    {
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
    public function passes($attribute = NULL, $value = NULL)
    {
        return
            $this->competition->slots_taken < $this->competition->slots_max && // not all slots yet taken
            in_array($this->competition->status, [Competition::STATUS_OPEN, Competition::STATUS_IN_PROGRESS]) && // competition is open or in progress
            (!$this->competition->end_time || $this->competition->end_time->gte(Carbon::now())); // start time is not in the past
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('app.competition_join_error');
    }
}
