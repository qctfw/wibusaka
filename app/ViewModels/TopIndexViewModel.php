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

                return collect($anime)->merge([
                    'aired' => [
                        'from' => (!is_null($anime['aired']['from'])) ? $anime['aired']['from']->translatedFormat('M Y') : '?',
                        'to' => (!is_null($anime['aired']['to'])) ? $anime['aired']['to']->translatedFormat('M Y') : '?'
                    ],
                    'members' => abbreviate_number($anime['members']),
                    'is_released' => $anime['status'] != __('anime.single.status_enums.not_yet_aired')
                ]);
            });

            return collect($item);
        });
    }
}
