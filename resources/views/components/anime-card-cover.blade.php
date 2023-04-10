<div {{ $attributes->merge(['class' => 'flex flex-col bg-gray-100 text-emerald-900 divide-y divide-gray-400 rounded-lg group dark:bg-gray-800 dark:text-gray-50 divide-opacity-50 divide-dashed']) }}>
    <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="relative flex items-center w-full mx-auto rounded-lg font-primary h-60 md:h-64 lg:h-64 xl:h-72 anime-cover">
        <div class="flex flex-col items-center justify-center w-full h-72 spinner">
            <i class="animate-spin fa-solid fa-spinner text-lg text-gray-800 dark:text-gray-100"></i>
        </div>
        <img alt="{{ $anime['titles']['default'][0] }} Anime Poster" data-src="{{ $anime['images']['webp']['small_image_url'] }}" srcset="{{ $anime['images']['webp']['large_image_url'] }} 1.25x" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto rounded-lg opacity-0" loading="lazy" />
        <div class="absolute inset-x-0 bottom-0 py-1 bg-black bg-opacity-50">
            <h4 class="p-1 text-lg font-semibold leading-tight text-center text-emerald-100 transition-colors duration-200 group-hover:text-emerald-300 dark:group-hover:text-emerald-300">
                {{ $anime['titles']['default'][0] }}
            </h4>
        </div>
    </a>
    <div class="grid items-center justify-center grid-cols-2 px-2 py-1 text-sm text-center xl:text-base">
        <div class="flex flex-row items-center gap-2 text-left">
            <div class="w-4 text-center"><i class="fa-solid fa-user"></i></div>
            <span>{{ abbreviate_number($anime['members']) }}</span>
        </div>
        <div class="flex flex-row items-center gap-2 text-left">
            @if ($anime['score'] > 0)
            <div class="w-4 text-center"><i class="fa-solid fa-star"></i></div>
            <span>{{ $anime['score'] }}</span>
            @else
            <div class="w-4 text-center"><i class="fa-solid fa-calendar-day"></i></div>
            <span>{{ $anime->airedFromFormat('d M') }}</span>
            @endif
        </div>
        <div class="flex flex-row items-center gap-2 text-left">
            <div class="w-4 text-center"><i class="fa-solid fa-video"></i></div>
            <span>{{ $anime['type'] }}</span>
        </div>
        <div class="flex flex-row items-center gap-2 text-left">
            <div class="w-4 text-center"><i class="fa-solid fa-film"></i></div>
            <span>{{ $anime['episodes'] ?? '?' }} ep</span>
        </div>
    </div>

    @if ($anime['status'] == __('anime.single.status_enums.not_yet_aired') && ( (is_null($resources)) || (!is_null($resources) && $resources->isEmpty()) ))
    <div class="flex flex-row flex-grow items-center justify-center gap-3 p-1 text-sm text-center">
        <span class="italic">{{ __('anime.single.coming_soon') }}</span>
    </div>
    @elseif (!is_null($resources))
    <div class="flex flex-row flex-grow flex-wrap items-center justify-center gap-x-3 gap-y-1 p-1 text-sm text-center">
        @forelse ($resources as $resource)
        <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6" title="{{ $resource->alternative_note }}">
            <img src="{{ logo_asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
        </a>
        @empty
        <i class="fa-solid fa-xmark text-2xl"></i>
        <span>{{ __('anime.single.availability_empty_short') }}</span>
        @endforelse
    </div>
    @endif
</div>
