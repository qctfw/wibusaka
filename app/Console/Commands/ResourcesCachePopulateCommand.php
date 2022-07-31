<?php

namespace App\Console\Commands;

use App\Models\Resource;
use App\Services\Contracts\ResourceServiceInterface;
use Illuminate\Console\Command;

class ResourcesCachePopulateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resources:cache-populate {--f|flush : Flush the current resource cache}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the resources cache';

    /**
     * @var ResourceServiceInterface
     */
    private $resource_service;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ResourceServiceInterface $resource_service)
    {
        parent::__construct();

        $this->resource_service = $resource_service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('flush')) {
            $this->line('Flushing current resources...');
            $this->call(ResourcesCacheFlushCommand::class);
        }

        $mal_ids = Resource::distinct()->get('mal_id')->pluck('mal_id');

        $this->line('Collected unique ' . $mal_ids->count() . ' MyAnimeList IDs that has resources.');

        $this->resource_service->getByMalIds($mal_ids);

        $this->components->info('Anime resources has been successfully cached.');
        return 0;
    }
}
