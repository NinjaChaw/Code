<?php

namespace App\Services;

use App\Models\Currency;
use App\Services\API\OpenExchangeRatesApi;
use Illuminate\Support\Facades\Log;

class CurrencyService extends Service
{
    private $api;

    public function __construct()
    {
        $this->api = new OpenExchangeRatesApi(config('settings.openexchangerates_api_key'));
    }

    public function bulkUpdateMarketData()
    {
        // get quotes from API
        $quotes = $this->api->latest();
        $baseCurrency = config('settings.currency');
        $baseCurrencyRate = isset($quotes->$baseCurrency) ? $quotes->$baseCurrency : 1;

        // loop through currencies and update its rate
        foreach (Currency::cursor() as $currency) {
            if (isset($quotes->{$currency->code})) {
                $currency->rate = $quotes->{$currency->code} / $baseCurrencyRate;
                $currency->save();
            }
        }
    }
}