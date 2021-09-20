<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Genre::count() > 0) {
            return;
        }

        $datas = $this->getData();

        foreach ($datas as $id => $name)
        {
            $genre = new Genre();
            $genre->id = $id;
            $genre->name = $name;

            $genre->save();
        }
    }

    private function getData()
    {
        return [
            1 => "Action",
            2 => "Adventure",
            3 => "Cars",
            4 => "Comedy",
            5 => "Avant Garde",
            6 => "Demons",
            7 => "Mystery",
            8 => "Drama",
            9 => "Ecchi",
            10 => "Fantasy",
            11 => "Game",
            12 => "Hentai",
            13 => "Historical",
            14 => "Horror",
            15 => "Kids",
            16 => "Magic",
            17 => "Martial Arts",
            18 => "Mecha",
            19 => "Music",
            20 => "Parody",
            21 => "Samurai",
            22 => "Romance",
            23 => "School",
            24 => "Sci Fi",
            25 => "Shoujo",
            26 => "Girls Love",
            27 => "Shounen",
            28 => "Boys Love",
            29 => "Space",
            30 => "Sports",
            31 => "Super Power",
            32 => "Vampire",
            33 => "Yaoi",
            34 => "Yuri",
            35 => "Harem",
            36 => "Slice of Life",
            37 => "Supernatural",
            38 => "Military",
            39 => "Police",
            40 => "Psychological",
            41 => "Suspense",
            42 => "Seinen",
            43 => "Josei",
            46 => 'Award Winning',
            47 => 'Gourmet',
            48 => 'Work Life',
            49 => 'Erotica'
        ];
    }
}
