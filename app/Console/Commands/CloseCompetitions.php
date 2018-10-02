<?php

namespace App\Console\Commands;

use App\Services\CompetitionExpiryService;
use Illuminate\Console\Command;

class CloseCompetitions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'competition:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if any competitions are expired (finished) and close them accordingly.';

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
    public function handle(CompetitionExpiryService $competitionExpiryService)
    {
        $competitionExpiryService->run();
    }
}
