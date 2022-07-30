<x-app-layout>
    <x-slot name="title">{{ __('anime.producer.title') }} / {{ $producer['titles']['default']['title'] }}{{ ($page > 1) ? ' (Hal. ' . $page . ')' : '' }}</x-slot>
    <x-slot name="meta_title">{{ __('anime.producer.title') }} / {{ $producer['titles']['default']['title'] }}</x-slot>
    <x-slot name="meta_robots">noindex, nofollow</x-slot>
    
    <div class="flex flex-col gap-3">
        <div>
            <div class="float-left mr-4 lg:mr-8">
                <div class="relative w-44 lg:w-48 anime-cover">
                    <div class="flex flex-col items-center justify-center w-full h-44 lg:h-48 spinner">
                        <x-icons.spinner class="block w-5 h-5" />
                    </div>
                    <img data-src="{{ $producer['images']['jpg']['image_url'] }}" alt="{{ $producer['titles']['default']['title'] }}" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto opacity-0" loading="lazy" />
                </div>
                <div class="grid grid-cols-5 gap-1 mt-2">
                    <a href="{{ $producer['url'] }}" title="{{ $producer['titles']['default']['title'] }} MyAnimeList" target="_blank">
                        <img src="{{ logo_asset('img/logos/myanimelist.webp') }}" alt="{{ $producer['titles']['default']['title'] }} MyAnimeList" class="w-8 h-8 rounded" />
                    </a>
                    @foreach ($producer['external'] as $site)
                        @php
                            $site_type = guess_site($site['url']);
                            if (!in_array($site_type, ['twitter', 'instagram', 'youtube', 'facebook']))
                                $site_type = 'globe-solid';

                            $logo_str = sprintf('<a href="%s" title="%s" target="_blank"><x-icons.%s class="w-8 h-8 transition-colors duration-150 hover:text-emerald-300 dark:hover:text-gray-300" fill="currentColor" /></a>', $site['url'], $site['name'], $site_type);
                        @endphp
                        {!! \Blade::render($logo_str) !!}
                    @endforeach
                </div>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-left text-emerald-700 dark:text-emerald-300 font-primary lg:text-5xl">{{ $producer['titles']['default']['title'] }}</h2>
                <div class="flex flex-col pt-1 text-sm text-left">
                    <p>{{ $producer['titles']['japanese']['title'] ?? '' }}</p>
                    <p>({{ $producer['established'] }})</p>
                </div>
                <p class="mt-3">{!! nl2br(e($producer['about'])) !!}</p>
            </div>
        </div>

        <div class="flex flex-col items-center justify-between gap-8 pb-4 md:flex-row">
            <div class="hidden md:flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
                <x-title>Anime {{ $producer['titles']['default']['title']  }}</x-title>
            </div>
            @if ($pagination['last_visible_page'] > 1) <x-pagination-link :current="$page" :total="$pagination['last_visible_page']" /> @endif
        </div>
    </div>

    <x-anime-list>
        @foreach ($animes as $anime)
            <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
        @endforeach
    </x-anime-list>
    @if ($pagination['last_visible_page'] > 1)
    <div class="flex flex-col items-center justify-between gap-2 mt-4 md:flex-row">
        <div class="font-primary">Halaman {{ $page }} / {{ $pagination['last_visible_page'] }}</div>
        <x-pagination-link :current="$page" :total="$pagination['last_visible_page']" />
    </div>
    @endif
</x-app-layout>