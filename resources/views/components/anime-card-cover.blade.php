<div {{ $attributes->merge(['class' => 'flex flex-col bg-gray-100 text-green-900 divide-y divide-gray-400 rounded-lg group dark:bg-gray-800 dark:text-gray-50 divide-opacity-50 divide-dashed']) }}>
    <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="relative flex items-center w-full mx-auto rounded-lg font-primary h-60 md:h-64 lg:h-64 xl:h-72 anime-cover">
        <div class="flex flex-col items-center justify-center w-full h-72 spinner">
            <x-icons.spinner class="block w-5 h-5" />
        </div>
        <img alt="{{ $anime['title'] }} Anime Poster" data-src="{{ $anime['image_url'] }}" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto rounded-lg opacity-0" loading="lazy" />
        <div class="absolute inset-x-0 bottom-0 py-1 bg-black bg-opacity-50">
            <h4 class="p-1 text-lg font-semibold leading-tight text-center text-green-100 transition-colors duration-200 group-hover:text-green-300 dark:group-hover:text-green-300">
                {{ $anime['title'] }}
            </h4>
        </div>
    </a>
    <div class="grid items-center justify-center grid-cols-2 px-2 py-1 text-sm text-center xl:text-base">
        <div class="flex flex-row items-center gap-2 text-left">
            <x-icons.user-solid class="w-5 h-5" />
            <span>{{ $anime['members'] }}</span>
        </div>
        <div class="flex flex-row items-center gap-2 text-left">
            @if ($anime['score'] > 0)
            <x-icons.star-solid class="w-5 h-5" />
            <span>{{ $anime['score'] }}</span>
            @else
            <x-icons.calendar-solid class="w-5 h-5" />
            <span>{{ $anime['start_date'] }}</span>
            @endif
        </div>
        <div class="flex flex-row items-center gap-2 text-left">
            <x-icons.video-camera-solid class="w-5 h-5" />
            <span>{{ $anime['type'] }}</span>
        </div>
        <div class="flex flex-row items-center gap-2 text-left">
            <x-icons.collection-solid class="w-5 h-5" />
            <span>{{ $anime['episodes'] ?? '?' }} ep</span>
        </div>
    </div>

    @if (!is_null($resources))
    <div class="flex flex-row items-center justify-center gap-3 py-1 text-sm text-center">
        @forelse ($resources as $resource)
        <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6">
            <img src="{{ logo_asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
        </a>
        @empty
        <x-icons.x class="w-6 h-6" />
        <span>{{ __('anime.single.availability_empty_short') }}</span>
        @endforelse
    </div>
    @endif
</div>