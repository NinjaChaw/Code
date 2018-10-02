<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check that table is empty
        if (DB::table('assets')->count() != 0)
            return;

        $now = Carbon::now();

        $assets = (array) json_decode(file_get_contents(base_path() . '/database/seeds/data/coins.json'));
        $assets = array_map(function ($asset) use ($now) {
            return [
                'symbol'        => $asset->symbol,
                'name'          => $asset->name,
                'logo'          => isset($asset->logo) ? $asset->logo : NULL,
                'status'        => \App\Models\Asset::STATUS_ACTIVE,
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }, $assets);

        DB::table('assets')->insert($assets);
    }
}
