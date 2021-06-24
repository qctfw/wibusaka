<?php

namespace App\Services;

use App\Models\Resource;
use App\Services\Contracts\ResourceServiceInterface;

class ResourceService implements ResourceServiceInterface
{
    public function getByMalId(int $mal_id)
    {
        $resources = Resource::with('platform')->byMalId($mal_id)->get()->sortBy('platform.name', SORT_NATURAL | SORT_FLAG_CASE);

        return $resources;
    }

    public function getByMalIds(array $mal_ids)
    {
        $resources = Resource::with('platform')->byMalId($mal_ids)->get();

        $resources_result = collect();
        foreach ($mal_ids as $mal_id) {
            $result = $resources->where('mal_id', $mal_id)->sortBy('platform.name', SORT_NATURAL | SORT_FLAG_CASE)->values();
            $resources_result->put($mal_id, $result);
        }

        return $resources_result;
    }
}
