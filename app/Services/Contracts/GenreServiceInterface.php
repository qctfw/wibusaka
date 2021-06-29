<?php

namespace App\Services\Contracts;

interface GenreServiceInterface
{
    public function getBySlug(string $slug);
}
