<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check that table is empty
        if (DB::table('currencies')->count() != 0)
            return;

        $now = Carbon::now();
        $currencies = (array) json_decode(file_get_contents(base_path() . '/database/seeds/data/currencies.json'));
        $currencies = array_map(function ($currency) use ($now) {
            return [
                'code'          => $currency->code,
                'name'          => $currency->name,
                'symbol_native' => $currency->symbol_native,
                'rate'          => 0,
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }, $currencies);

        DB::table('currencies')->insert($currencies);
    }
}
