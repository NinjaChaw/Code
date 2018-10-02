<?php

namespace App\Rules;

use App\Models\Asset;
use Illuminate\Contracts\Validation\Rule;

class AssetPriceIsValid implements Rule
{
    private $asset;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
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
        return $this->asset->price > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('app.asset_not_tradeable');
    }
}
