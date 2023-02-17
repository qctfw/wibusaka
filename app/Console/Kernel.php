<?php

namespace App\Console;

use App\Console\Commands\JikanCachePopulateCommand;
use App\Console\Commands\ResourcesCachePopulateCommand;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(JikanCachePopulateCommand::class)->dailyAt('00:01');
        $schedule->command(ResourcesCachePopulateCommand::class, ['--flush'])->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
