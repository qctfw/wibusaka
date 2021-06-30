<?php

namespace App\Services\Contracts;

interface GenreServiceInterface
{
    public function all();
    public function getBySlug(string $slug);
}
