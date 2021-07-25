<?php

return [
    'asset' => [
        'base_url' => env('WIBULIST_ASSET_BASE_URL')
    ],
    'season' => [
        'minimum' => [
            'tv' => env('ANIME_SEASON_MINIMUM_TV'),
            'tv_continuing' => env('ANIME_SEASON_MINIMUM_TV_CONTINUING'),
            'ona' => env('ANIME_SEASON_MINIMUM_ONA'),
            'ova' => env('ANIME_SEASON_MINIMUM_OVA'),
            'movie' => env('ANIME_SEASON_MINIMUM_MOVIE'),
            'special' => env('ANIME_SEASON_MINIMUM_SPECIAL')
        ]
    ],
    'link' => [
        'discord' => env('WIBULIST_LINK_DISCORD', '#'),
        'github' => env('WIBULIST_LINK_GITHUB', '#'),
        'twitter' => env('WIBULIST_LINK_TWITTER', '#')
    ]
];