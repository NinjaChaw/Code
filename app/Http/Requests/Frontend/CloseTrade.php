<?php

namespace App\Http\Requests\Frontend;

use App\Rules\AssetPriceIsValid;
use App\Rules\CompetitionIsInProgress;
use App\Rules\UserCanCloseTrade;
use Illuminate\Foundation\Http\FormRequest;

class CloseTrade extends FormRequest
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
        return [
            '*' => [
                new AssetPriceIsValid($this->trade->asset),
                new CompetitionIsInProgress($this->competition),
                new UserCanCloseTrade($this->trade, $this->competition, $this->user())
            ],
        ];
    }
}
