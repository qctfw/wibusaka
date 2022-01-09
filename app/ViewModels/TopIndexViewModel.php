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

                $anime['aired_at'] = (isset($anime['aired']['from'])) ? Carbon::parse($anime['aired']['from']) : null;

                return collect($anime)->merge([
                    'aired_at' => (!is_null($anime['aired_at'])) ? $anime['aired_at']->translatedFormat('M Y') : '?',
                    'members' => abbreviate_number($anime['members']),
                    'is_released' => (!is_null($anime['aired_at'])) ? now()->gte($anime['aired_at']) : false,
                    'score' => ($anime['score'] > 0) ? number_format($anime['score'], 2, '.', '') : 0
                ]);
            });

            return collect($item);
        });
    }
}
