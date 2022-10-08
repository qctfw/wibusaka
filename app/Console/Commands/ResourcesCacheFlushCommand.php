<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ResourcesCacheFlushCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resources:cache-flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush the resources cache';

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
     * @return int
     */
    public function handle()
    {
        Cache::tags(['db', 'db-anime-resources'])->flush();
        $this->components->info('Anime resources cache has been flushed.');

        return Command::SUCCESS;
    }
}
