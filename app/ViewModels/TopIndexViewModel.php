<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Spatie\ViewModels\ViewModel;

class TopIndexViewModel extends ViewModel
{
    /**
     * @var Collection
     */
    public $sections;
    
    /**
     * @var Collection
     */
    public $resources;

    public function __construct(Collection $sections, Collection $resources)
    {
        $this->sections = $sections;
        $this->resources = $resources;
    }

    public function sections()
    {
        return $this->sections->map(function ($item, $key) {
            $item['animes'] = $item['animes']->map(function ($anime, $key) {

                if (isset($anime['airing_start']))
                {
                    $anime['start_date'] = $anime['airing_start'];
                }

                return collect($anime)->merge([
                    'start_date' => (isset($anime['start_date'])) ? Carbon::parse($anime['start_date'])->translatedFormat('M Y') : '?',
                    'members' => abbreviate_number($anime['members']),
                    "score" => ($anime['score'] > 0) ? number_format($anime['score'], 2, '.', '') : 0
                ]);
            });

            return collect($item);
        });
    }
}
