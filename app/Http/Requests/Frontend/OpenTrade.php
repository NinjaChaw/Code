<?php

namespace App\Http\Requests\Frontend;

use App\Models\Trade;
use App\Rules\AssetCanBeTraded;
use App\Rules\FreeMarginIsSufficient;
use App\Rules\CompetitionIsInProgress;
use Illuminate\Foundation\Http\FormRequest;

class OpenTrade extends FormRequest
{
    private $competitionParticipant;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'volume'        => 'required|numeric|min:'.$this->competition->volume_min.'|max:'.$this->competition->volume_max,
            'direction'     => 'required|integer|in:' . implode(',', [Trade::DIRECTION_BUY, Trade::DIRECTION_SELL]),
            '*'             => [
                new AssetCanBeTraded($this->asset),
                new CompetitionIsInProgress($this->competition),
                new FreeMarginIsSufficient(
                    $this->asset,
                    $this->competition,
                    $this->user(),
                    $this->volume
                ),
            ],
        ];
    }
}