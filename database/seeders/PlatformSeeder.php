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
                'icon_url' => 'icons/youtube.png'
            ],
            [
                'name' => 'Crunchyroll',
                'icon_url' => 'icons/crunchyroll.png'
            ],
            [
                'name' => 'Netflix',
                'icon_url' => 'icons/netflix.png'
            ],
            [
                'name' => 'Sushiroll',
                'icon_url' => 'icons/sushiroll.png'
            ],
            [
                'name' => 'iQIYI',
                'icon_url' => 'icons/iqiyi.png'
            ],
            [
                'name' => 'iFlix',
                'icon_url' => 'icons/iflix.png'
            ],
            [
                'name' => 'CATCHPLAY+',
                'icon_url' => 'icons/catchplay-plus.png'
            ],
            [
                'name' => 'VIU',
                'icon_url' => 'icons/viu.png'
            ],
            [
                'name' => 'Spotify',
                'icon_url' => 'icons/spotify.png'
            ],
        ];
    }
}
