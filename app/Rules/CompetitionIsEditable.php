<?php

namespace App\Rules;

use App\Models\Competition;
use Illuminate\Contracts\Validation\Rule;

class CompetitionIsEditable implements Rule
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
    public function passes($attribute = NULL, $value = NULL)
    {
        return !in_array($this->competition->status, [Competition::STATUS_CANCELLED, Competition::STATUS_COMPLETED]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('app.competition_edit_warning');
    }
}
