<?php

namespace App\Services;

use App\Models\Resource;
use App\Services\Contracts\ResourceServiceInterface;

class ResourceService implements ResourceServiceInterface
{
    public function getByMalId(int $mal_id)
    {
        $resources = Resource::with('platform')->ofMalId($mal_id)->get()->sortBy('platform.name', SORT_NATURAL|SORT_FLAG_CASE);

        return $resources;
    }
}
