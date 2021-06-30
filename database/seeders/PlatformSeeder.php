<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Platform::count() > 0)
            return;

        $datas = $this->getData();
        foreach ($datas as $data)
        {
            $platform = new Platform();
            $platform->name = $data['name'];
            $platform->type = $data['type'];
            $platform->icon_path = $data['icon_path'];
            $platform->save();
        }
    }

    private function getData()
    {
        return [
            [
                'name' => 'YouTube',
                'type' => 'stream',
                'icon_path' => 'icons/youtube.webp'
            ],
            [
                'name' => 'Crunchyroll',
                'type' => 'stream',
                'icon_path' => 'icons/crunchyroll.webp'
            ],
            [
                'name' => 'Netflix',
                'type' => 'stream',
                'icon_path' => 'icons/netflix.webp'
            ],
            [
                'name' => 'Sushiroll',
                'type' => 'stream',
                'icon_path' => 'icons/sushiroll.webp'
            ],
            [
                'name' => 'iQIYI',
                'type' => 'stream',
                'icon_path' => 'icons/iqiyi.webp'
            ],
            [
                'name' => 'iFlix',
                'type' => 'stream',
                'icon_path' => 'icons/iflix.webp'
            ],
            [
                'name' => 'CATCHPLAY+',
                'type' => 'stream',
                'icon_path' => 'icons/catchplay-plus.webp'
            ],
            [
                'name' => 'VIU',
                'type' => 'stream',
                'icon_path' => 'icons/viu.webp'
            ],
            [
                'name' => 'Spotify',
                'type' => 'stream',
                'icon_path' => 'icons/spotify.webp'
            ],
        ];
    }
}
