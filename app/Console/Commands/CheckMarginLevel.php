<?php

namespace App\Console\Commands;

use App\Services\MarginCallService;
use Illuminate\Console\Command;

class CheckMarginLevel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'competition:check-margin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check margin level requirements for every participant in each open competition.';

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
    public function handle(MarginCallService $marginCallService)
    {
        $marginCallService->run();
    }
}
