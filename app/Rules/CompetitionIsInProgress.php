<?php

namespace App\Rules;

use App\Models\Competition;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class CompetitionIsInProgress implements Rule
{
    private $competition;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
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
        $now = Carbon::now();
        return $this->competition->status == Competition::STATUS_IN_PROGRESS
            && $this->competition->start_time // not empty
            && $this->competition->end_time // not empty
            && $this->competition->start_time->lte($now)
            && $this->competition->end_time->gte($now);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('app.competition_not_in_progress');
    }
}
