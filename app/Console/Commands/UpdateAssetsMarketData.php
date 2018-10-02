<?php

namespace App\Console\Commands;

use App\Services\AssetService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateAssetsMarketData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asset:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull current assets quotes data from API and persist it to the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(AssetService $assetService)
    {
        $assetService->bulkUpdateMarketData();
    }
}
