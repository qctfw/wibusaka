<?php

namespace App\Services;

use App\Models\Genre;
use App\Services\Contracts\GenreServiceInterface;

class GenreService implements GenreServiceInterface
{
    public function getBySlug(string $slug)
    {
        $name = ucwords(str_replace('-', ' ', $slug));

        $genre = Genre::where('name', $name)->firstOrFail();

        return $genre;
    }
}
