<?php

namespace App\Services;

use App\Models\Genre;
use App\Services\Contracts\GenreServiceInterface;

class GenreService implements GenreServiceInterface
{
    public function all()
    {
        $all_genres = Genre::whereNotIn('name', ['Hentai', 'Yuri', 'Yaoi'])->get();

        return $all_genres;
    }

    public function getBySlug(string $slug)
    {
        $name = ucwords(str_replace('-', ' ', $slug));

        if (in_array($name, ['Hentai', 'Yuri', 'Yaoi']))
        {
            abort(404);
        }

        $genre = Genre::where('name', $name)->firstOrFail();

        return $genre;
    }
}
