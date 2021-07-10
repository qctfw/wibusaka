<?php

namespace App\Services;

use App\Models\Resource;
use App\Services\Contracts\ResourceServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ResourceService implements ResourceServiceInterface
{
    public function getByMalId(int $mal_id)
    {
        $resources = $this->getFromCache($mal_id);
        if ($this->getFromCache($mal_id))
        {
            return $resources;
        }

        $resources = Resource::with('platform')->byMalId($mal_id)->get()->sortBy('platform.name', SORT_NATURAL | SORT_FLAG_CASE);

        $this->setResourceCache($resources, $mal_id);

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
            
            foreach ($mal_ids_db as $mal_id) {
                $resources = $resources_db->where('mal_id', $mal_id)->sortBy('platform.name', SORT_NATURAL | SORT_FLAG_CASE)->values();
                
                if ($resources->count() > 0) {
                    $resources_result->put($mal_id, $resources);
                }
                else {
                    $resources_result->put($mal_id, null);
                }
                $this->setResourceCache($resources, $mal_id);
                
            }
        }

        return $resources_result;
    }

    private function getFromCache(int $mal_id)
    {
        $cache_key = $this->getCacheKey($mal_id);

        $cache = Cache::get($cache_key);

        return $cache;
    }

    private function setResourceCache($resources, int $mal_id)
    {
        $cache_key = $this->getCacheKey($mal_id);

        Cache::put($cache_key, $resources, now()->endOfDay());
    }

    private function getCacheKey(int $mal_id)
    {
        return Str::lower(config('app.name')) . ':db:resource:' . $mal_id;
    }
}
