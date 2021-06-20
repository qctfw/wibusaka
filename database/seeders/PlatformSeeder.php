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
            $platform->icon_url = $data['icon_url'];
            $platform->save();
        }
    }

    private function getData()
    {
        return [
            [
                'name' => 'YouTube',
                'icon_url' => 'icons/youtube.webp'
            ],
            [
                'name' => 'Crunchyroll',
                'icon_url' => 'icons/crunchyroll.webp'
            ],
            [
                'name' => 'Netflix',
                'icon_url' => 'icons/netflix.webp'
            ],
            [
                'name' => 'Sushiroll',
                'icon_url' => 'icons/sushiroll.webp'
            ],
            [
                'name' => 'iQIYI',
                'icon_url' => 'icons/iqiyi.webp'
            ],
            [
                'name' => 'iFlix',
                'icon_url' => 'icons/iflix.webp'
            ],
            [
                'name' => 'CATCHPLAY+',
                'icon_url' => 'icons/catchplay-plus.webp'
            ],
            [
                'name' => 'VIU',
                'icon_url' => 'icons/viu.webp'
            ],
            [
                'name' => 'Spotify',
                'icon_url' => 'icons/spotify.webp'
            ],
        ];
    }
}
