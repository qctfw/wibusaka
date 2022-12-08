@php
    $interval = now()->diff(\Carbon\Carbon::create($anime['aired']['from']->format('l H:i')));
    $time_difference = (int) ($interval->format('%r') . ($interval->days * 86400 + $interval->h * 3600 + $interval->i * 60 + $interval->s));
@endphp
<div class="relative flex flex-col bg-gray-100 rounded-lg dark:bg-gray-800">
    <div x-data="countdownData({{ $time_difference }}, {{ explode(' ', $anime['duration'])[0] }})" x-init="countdownTimer()" class="absolute inset-x-0 bottom-0 flex flex-row items-center justify-center w-2/5 gap-3 py-1 z-20 rounded-bl-lg bg-gray-200 bg-opacity-80 dark:bg-gray-900 dark:bg-opacity-60">
        <div class="text-md timer lg:text-lg xl:text-xl" x-text="timerString"></div>
    </div>
    <div class="flex flex-row h-44 md:h-40 lg:h-52 2xl:h-64 divide-x divide-gray-400 divide-dashed divide-opacity-50">
        <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="relative w-2/5 mx-auto h-44 md:h-40 lg:h-52 2xl:h-64 anime-cover">
            <div class="flex flex-col items-center justify-center w-1/2 mx-auto h-72 spinner">
                <x-icons.spinner class="block w-5 h-5" />
            </div>
            <img alt="{{ $anime['title'] }} Anime Poster" data-src="{{ $anime['images']['webp']['image_url'] }}" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto opacity-0 rounded-l" loading="lazy" />
            @if (!$anime['explicit_genres']->isEmpty())
            <div x-data="{showCover: false}" x-on:click.prevent="showCover = true" x-show="!showCover" class="absolute inset-x-0 top-0 flex items-center justify-center w-full h-full text-gray-200 backdrop-blur">
                <div class="flex items-center px-2 py-1 bg-gray-800 rounded">Lihat</div>
            </div>
            @endif
        </a>
        <div class="flex flex-col w-3/5 px-2 py-2">
            <div class="flex flex-col gap-1 text-sm xl:text-base overflow-y-auto scrollbar-extra-thin scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
                <div x-data="{ title: `{{ $anime['title'] }}` }" class="flex">
                    <a
                        href="{{ route('anime.show', $anime['mal_id']) }}"
                        rel="nofollow"
                        class="font-semibold leading-none font-primary text-link"
                        x-bind:class="title.length <= 50 ? 'text-lg xl:text-xl 2xl:text-2xl' : title.length <= 80 ? 'text-md 2xl:text-lg' : 'text-sm'"
                        x-text="title"></a>
                </div>
                @if ($anime['studios']->isNotEmpty())
                <div class="flex-row hidden lg:flex">
                    <p><span class="font-semibold">Studio</span>: 
                    @foreach ($anime['studios'] as $studio)
                    <a href="{{ route('anime.producer', ['id' => $studio['mal_id']]) }}" class="text-link">{{ $studio['name'] }}</a>{{ (!$loop->last) ? ',' : '' }}
                    @endforeach
                    </p>
                </div>
                @endif
                @if ($anime['genres']->isNotEmpty())
                <div class="hidden lg:flex">
                    <p><span class="font-semibold">Genre</span>: 
                        @foreach ($anime['genres'] as $genre)
                            <a href="{{ route('anime.genre.show', ['slug' => str_replace(' ', '-', strtolower($genre['name']))]) }}" class="text-link">{{ $genre['name'] }}</a>{{ (!$loop->last) ? ',' : '' }}
                        @endforeach
                    </p>
                </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 lg:text-base">
                    <div class="flex flex-row items-center gap-2 text-left lg:text-md">
                        <x-icons.user-solid class="w-5 h-5" />
                        <span>{{ abbreviate_number($anime['members']) }}</span>
                    </div>
                    <div class="flex flex-row items-center gap-2 text-left lg:text-md">
                        <x-icons.star-solid class="w-5 h-5" />
                        <span>{{ $anime['score'] }}</span>
                    </div>
                    <div class="flex flex-row items-center gap-2 text-left lg:text-md">
                        <x-icons.clock-solid class="w-5 h-5" />
                        <span>{{ $anime['broadcast']['time'] }} WIB</span>
                    </div>
                </div>
                <div class="flex gap-1 py-2 md:flex-col lg:flex-row">
                    <div class="flex flex-row flex-wrap items-center justify-center gap-3 px-2 py-1 rounded-lg bg-gray-200 bg-opacity-80 dark:bg-gray-900 dark:bg-opacity-60">
                        @forelse ($resources as $resource)
                        <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6 lg:w-7 lg:h-7" title="{{ $resource->alternative_note }}">
                            <img src="{{ logo_asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
                        </a>
                        @empty
                        <x-icons.x class="w-6 h-6 lg:w-7 lg:h-7" />
                        <span class="text-center text-sm lg:text-md px-2">{{ __('anime.single.availability_empty_short') }}</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>