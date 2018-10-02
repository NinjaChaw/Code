<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\Currency;
use App\Services\API\CoinCapApi;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AssetService extends Service
{
    private $api;

    public function __construct()
    {
        $this->api = new CoinCapApi();
    }

    /**
     * Return asset either from cache or from database
     *
     * @param Asset $asset
     * @return Asset
     */
    public function asset(Asset $asset) {
        $cacheTime = intval(config('settings.assets_quotes_rest_api_poll_freq')) / 60; // cache time in minutes
        return Cache::remember('asset-' . $asset->id, $cacheTime, function () use ($asset) {
            return $this->updateMarketData($asset);
        });
    }

    /**
     * Refresh data for a given asset and return it back
     *
     * @param Asset $asset
     * @return Asset
     */
    public function updateMarketData(Asset $asset) {
        if ($quote = $this->api->quote($asset->symbol)) {
            $baseCurrencyRate = $this->baseCurrencyRate();
            $asset->price       = isset($quote->price) ? $quote->price / $baseCurrencyRate : (isset($quote->price_usd) ? $quote->price_usd / $baseCurrencyRate : $asset->price);
            $asset->volume      = isset($quote->volume) ? $quote->volume : (isset($quote->volumeTotal) ? $quote->volumeTotal : 0);
            $asset->supply      = isset($quote->supply) ? $quote->supply : 0;
            $asset->market_cap  = isset($quote->market_cap) ? $quote->market_cap / $baseCurrencyRate : 0;
            $asset->save();
        }

        return $asset;
    }
    
    public function bulkUpdateMarketData() {
        // pull current quotes (bulk) from API and convert them to an array of objects keyed by symbol
        $quotes = collect((array) $this->api->quotes())->keyBy('short');
        $baseCurrencyRate = $this->baseCurrencyRate();

        // loop through assets in the DB and update quotes
        foreach (Asset::cursor() as $asset) {
            if ($quote = $quotes->get($asset->symbol)) {
                $asset->price       = $quote->price / $baseCurrencyRate;
                $asset->change_pct  = $quote->perc;
                $asset->change_abs  = $asset->price * (1 + $quote->perc/100) - $asset->price;
                $asset->volume      = $quote->volume;
                $asset->supply      = $quote->supply;
                $asset->market_cap  = $quote->mktcap / $baseCurrencyRate;
                $asset->save();
            }
        }

        // if some assets are not updated use direct endpoint
        Asset::where('price', '=', 0)->each(function ($asset) {
            $this->updateMarketData($asset);
        });
    }

    /**
     * Get base currency rate
     *
     * @return int
     */
    private function baseCurrencyRate() {
        // asset quotes are retrieved in USD,
        // so if default currency is different quotes need to be converted from USD to default currency
        if (config('settings.currency') != 'USD') {
            // in this case USD currency rate will be different from 1
            $baseCurrencyRate = Currency::find(1)->rate ?: 1;
        } else {
            $baseCurrencyRate = 1;
        }

        return $baseCurrencyRate;
    }
}