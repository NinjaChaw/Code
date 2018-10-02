<?php

namespace App\Http\Requests\Frontend;

use App\Rules\UserCanJoinCompetition;
use App\Rules\UserIsNotParticipant;
use Illuminate\Foundation\Http\FormRequest;

class JoinCompetition extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            '*' => [
                new UserIsNotParticipant($this->competition, $this->user()),
                new UserCanJoinCompetition($this->competition, $this->user()),
            ]
        ];

        return $rules;
    }
}
