<?php

namespace App\Console\Commands;

use App\Imports\AnimeResourcesImport;
use App\Models\Platform;
use App\Models\Resource;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportResourcesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resources:import {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the resources.';

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
        $filename = storage_path($this->argument('filename'));

        if (!file_exists($filename)) {
            $this->error('File not exists.');
            return -1;
        }
        $anime_resources_collections = Excel::toCollection(new AnimeResourcesImport, $filename)[0];

        $platforms = Platform::all();

        foreach ($anime_resources_collections as $current_row => $collection) {
            $current_row += 2;
            $platform = $platforms->where('name', $collection['platform'])->first();
            if (!$platform) {
                $this->warn('ROW #' . $current_row . ' - MAL ID ' . $collection['mal_id'] . ' has invalid platform (' . $collection['platform'] . ')');
                continue;
            }

            $resource_check = Resource::where([
                'mal_id' => $collection['mal_id'],
                'platform_id' => $platform->id
            ]);
            if ($resource_check->count() > 0) {
                $this->warn('ROW #' . $current_row . ' - MAL ID ' . $collection['mal_id'] . ' (' . $collection['platform'] . ') has already in the database');
                continue;
            }

            $resource = new Resource();
            $resource->mal_id = $collection['mal_id'];
            $resource->platform_id = $platform->id;
            $resource->paid = $collection['paid'];
            $resource->link = $collection['link'];
            $resource->note = $collection['note'];

            $success = $resource->save();
            if ($success)
                $this->info('ROW #' . $current_row . ' - MAL ID ' . $collection['mal_id'] . ' platform ' . $collection['platform'] . ' successfully added!');
        }

        $this->info('Importing done!');
        return 0;
    }
}
