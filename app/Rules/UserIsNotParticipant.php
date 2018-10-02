<?php

namespace App\Rules;

use App\Models\Competition;
use App\Models\CompetitionParticipant;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserIsNotParticipant implements Rule
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
        return CompetitionParticipant::where([
                ['competition_id',  $this->competition->id],
                ['user_id',         $this->user->id]
            ])
            ->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('app.you_are_participant');
    }
}
