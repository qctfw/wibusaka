<?php

namespace App\Services\Contracts;

interface ResourceServiceInterface
{
    public function getByMalId(int $mal_id);
    public function getByMalIds($mal_ids);
}
