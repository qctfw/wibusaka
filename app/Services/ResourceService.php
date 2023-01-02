<?php

namespace App\Services;

use App\Models\Resource;
use App\Services\Contracts\ResourceServiceInterface;
use Illuminate\Support\Facades\Cache;

class ResourceService implements ResourceServiceInterface
{
    public function getByMalId(int $mal_id)
    {
        $resources = $this->getFromCache($mal_id);
        if (is_null($resources))
        {
            $resources = Resource::with('platform')->byMalId($mal_id)->get()->sortBy('platform.name', SORT_NATURAL | SORT_FLAG_CASE);

            $this->setToCache($resources, $mal_id);
        }

        return $resources;
    }

    public function getByMalIds($mal_ids)
    {
        if (is_array($mal_ids)) {
            $mal_ids = collect($mal_ids);
        }

        $resources_result = collect();
        $mal_ids_db = collect();

        foreach ($mal_ids as $mal_id) {
            $resources_cache = $this->getFromCache($mal_id);

            if (!is_null($resources_cache)) {
                $resources_result->put($mal_id, $resources_cache);
            }
            else {
                $mal_ids_db->push($mal_id);
            }
        }

        if ($mal_ids_db->count() > 0) {
            $resources_db = Resource::with('platform')->byMalId($mal_ids_db->toArray())->get();

            $mal_ids_db->each(function ($mal_id) use ($resources_db, $resources_result) {
                $resources = $resources_db->where('mal_id', $mal_id)->sortBy('platform.name', SORT_NATURAL | SORT_FLAG_CASE)->values();

                $resources_result->put($mal_id, $resources);

                $this->setToCache($resources, $mal_id);
            });
        }

        return $resources_result;
    }

    private function getFromCache(int $mal_id)
    {
        $cache_key = $this->getCacheKey($mal_id);

        return Cache::tags(['db', 'db-anime-resources'])->get($cache_key);
    }

    private function setToCache($resources, int $mal_id)
    {
        $cache_key = $this->getCacheKey($mal_id);

        Cache::tags(['db', 'db-anime-resources'])->put($cache_key, $resources);
    }

    private function getCacheKey(int $mal_id)
    {
        return 'db-anime-resources-' . $mal_id;
    }
}
