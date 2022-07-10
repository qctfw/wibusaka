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
            1 => 'Action',
            2 => 'Adventure',
            3 => 'Racing',
            4 => 'Comedy',
            5 => 'Avant Garde',
            6 => 'Mythology',
            7 => 'Mystery',
            8 => 'Drama',
            9 => 'Ecchi',
            10 => 'Fantasy',
            11 => 'Strategy Game',
            12 => 'Hentai',
            13 => 'Historical',
            14 => 'Horror',
            15 => 'Kids',
            17 => 'Martial Arts',
            18 => 'Mecha',
            19 => 'Music',
            20 => 'Parody',
            21 => 'Samurai',
            22 => 'Romance',
            23 => 'School',
            24 => 'Sci-Fi',
            25 => 'Shoujo',
            26 => 'Girls Love',
            27 => 'Shounen',
            28 => 'Boys Love',
            29 => 'Space',
            30 => 'Sports',
            31 => 'Super Power',
            32 => 'Vampire',
            35 => 'Harem',
            36 => 'Slice of Life',
            37 => 'Supernatural',
            38 => 'Military',
            39 => 'Detective',
            40 => 'Psychological',
            41 => 'Suspense',
            42 => 'Seinen',
            43 => 'Josei',
            46 => 'Award Winning',
            47 => 'Gourmet',
            48 => 'Workplace',
            49 => 'Erotica',
            50 => 'Adult Cast',
            51 => 'Anthropomorphic',
            52 => 'CGDCT',
            53 => 'Childcare',
            54 => 'Combat Sports',
            55 => 'Delinquents',
            56 => 'Educational',
            57 => 'Gag Humor',
            58 => 'Gore',
            59 => 'High Stakes Game',
            60 => 'Idols (Female)',
            61 => 'Idols (Male)',
            62 => 'Isekai',
            63 => 'Iyashikei',
            64 => 'Love Polygon',
            65 => 'Magical Sex Shift',
            66 => 'Mahou Shoujo',
            67 => 'Medical',
            68 => 'Organized Crime',
            69 => 'Otaku Culture',
            70 => 'Performing Arts',
            71 => 'Pets',
            72 => 'Reincarnation',
            73 => 'Reverse Harem',
            74 => 'Romantic Subtext',
            75 => 'Showbiz',
            76 => 'Survival',
            77 => 'Team Sports',
            78 => 'Time Travel',
            79 => 'Video Game',
            80 => 'Visual Arts',
            81 => 'Crossdressing'
        ];
    }
}
