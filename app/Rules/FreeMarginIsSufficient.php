<?php

namespace App\Rules;

use App\Models\Asset;
use App\Models\Competition;
use App\Models\User;
use App\Services\TradeService;
use Illuminate\Contracts\Validation\Rule;

class FreeMarginIsSufficient implements Rule
{
    private $asset;
    private $competition;
    private $user;
    private $volume;
    private $requiredMargin;

    /**
     * Create a new rule instance.
     *
     * @param $balance
     * @param $price
     * @param $lotSize
     * @param $volume
     * @param $leverage
     */
    public function __construct(Asset $asset, Competition $competition, User $user, $volume)
    {
        $this->asset = $asset;
        $this->competition = $competition;
        $this->user = $user;
        $this->volume = $volume;
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
        $tradeService = new TradeService($this->competition, $this->user);
        $this->requiredMargin = $tradeService->margin($this->asset, $this->volume);
        return $this->requiredMargin > 0 && $this->requiredMargin <= $tradeService->freeMargin($this->user);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('app.free_margin_not_sufficient', ['amount' => $this->requiredMargin]);
    }
}