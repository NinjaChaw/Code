<?php

namespace App\Services\API;

class CoinCapApi extends API
{
    protected $baseUri = 'https://coincap.io/';

    public function quote($symbol) {
        return $this->getJson('page/' . $symbol);
    }

    public function quotes() {
        return $this->getJson('front');
    }
}