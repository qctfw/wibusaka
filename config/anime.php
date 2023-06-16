<?php

return [
    'asset' => [
        'base_url' => env('WIBUSAKA_ASSET_BASE_URL'),
        'logo' => [
            'default' => env('WIBUSAKA_LOGO_PATH'),
            'jp' => env('WIBUSAKA_LOGO_JP_PATH')
        ]
    ],
    'season' => [
        'minimum' => [
            'tv' => env('ANIME_SEASON_MINIMUM_TV'),
            'tv_continuing' => env('ANIME_SEASON_MINIMUM_TV_CONTINUING'),
            'ona' => env('ANIME_SEASON_MINIMUM_ONA'),
            'ova' => env('ANIME_SEASON_MINIMUM_OVA'),
            'movie' => env('ANIME_SEASON_MINIMUM_MOVIE'),
            'special' => env('ANIME_SEASON_MINIMUM_SPECIAL')
        ],
        'min_members' => env('ANIME_SEASON_MINIMUM')
    ],
    'index' => [
        'max_schedule' => env('ANIME_UPCOMING_SCHEDULE_INDEX_MAXIMUM'),
    ],
    'jikan' => [
        'base_url' => env('JIKAN_BASE_URL'),
    ],
    'link' => [
        'api-doc' => env('WIBUSAKA_LINK_API_DOCS', '#'),
        'discord' => env('WIBUSAKA_LINK_DISCORD', '#'),
        'github' => env('WIBUSAKA_LINK_GITHUB', '#'),
        'twitter' => env('WIBUSAKA_LINK_TWITTER', '#'),
        'trakteer' => env('WIBUSAKA_LINK_TRAKTEER', '#'),
    ]
];
