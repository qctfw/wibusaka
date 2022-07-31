<?php

namespace App\Console\Commands;

use App\Services\Contracts\JikanServiceInterface;
use Illuminate\Console\Command;

class JikanCachePopulateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jikan:cache-populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the mandatory Jikan cache';

    public function __construct(private JikanServiceInterface $jikan_service)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->newLine();
        $this->line('Populating current season, top airing, top upcoming, and today animes...');
        $this->newLine();

        $current_season = $this->jikan_service->getCurrentSeason();
        $this->info(sprintf(
            'Collected %d animes for this season (%s %d).',
            $current_season['animes']->count(),
            $current_season['seasons']['current']['season'],
            $current_season['seasons']['current']['year']
        ));
        sleep(1);
        
        $airing_animes = $this->jikan_service->getTopAnimes('airing');
        $this->info(sprintf(
            'Collected %d animes for top airing anime.',
            $airing_animes->count()
        ));
        sleep(1);
        
        $upcoming_animes = $this->jikan_service->getTopAnimes('upcoming');
        $this->info(sprintf(
            'Collected %d animes for top upcoming anime.',
            $upcoming_animes->count()
        ));
        sleep(1);

        $today_animes = $this->jikan_service->getAnimesBySchedule(strtolower(now()->format('l')));
        $this->info(sprintf(
            'Collected %d animes for today\'s anime schedule.',
            $today_animes->count()
        ));

        $this->newLine();
        $this->components->info('Jikan cache has been successfully cached.');
        
        return 0;
    }
}
