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
    'link' => [
        'discord' => env('WIBUSAKA_LINK_DISCORD', '#'),
        'github' => env('WIBUSAKA_LINK_GITHUB', '#'),
        'twitter' => env('WIBUSAKA_LINK_TWITTER', '#')
    ]
];