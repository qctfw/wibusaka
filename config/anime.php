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
        'min_members' => env('ANIME_SEASON_MINIMUM')
    ],
    'index' => [
        'max_schedule' => env('ANIME_UPCOMING_SCHEDULE_INDEX_MAXIMUM'),
    ],
    'link' => [
        'api-doc' => env('WIBUSAKA_LINK_API_DOCS', '#'),
        'discord' => env('WIBUSAKA_LINK_DISCORD', '#'),
        'github' => env('WIBUSAKA_LINK_GITHUB', '#'),
        'twitter' => env('WIBUSAKA_LINK_TWITTER', '#')
    ]
];