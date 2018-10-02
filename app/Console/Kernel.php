<?php

namespace App\Console;

use App\Console\Commands\CheckMarginLevel;
use App\Console\Commands\CloseCompetitions;
use App\Console\Commands\UpdateAssetsMarketData;
use App\Console\Commands\UpdateCurrenciesMarketData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UpdateAssetsMarketData::class,
        UpdateCurrenciesMarketData::class,
        CheckMarginLevel::class,
        CloseCompetitions::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('asset:update')->everyFiveMinutes();
        $schedule->command('currency:update')->hourly();
        $schedule->command('competition:check-margin')->everyFiveMinutes();
        $schedule->command('competition:close')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
