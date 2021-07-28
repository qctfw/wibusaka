<div class="flex flex-col bg-gray-200 divide-y divide-gray-400 rounded-lg group dark:bg-gray-900 divide-opacity-50 divide-dashed">
    <a href="{{ route('anime.show', $anime['mal_id']) }}" class="relative w-full mx-auto rounded-lg anime-cover">
        <div class="flex flex-col items-center justify-center w-full h-80 spinner">
            <x-icons.spinner class="block w-5 h-5" />
        </div>
        <img alt="{{ $anime['title'] }} Anime Poster" data-src="{{ $anime['image_url'] }}" class="absolute inset-x-0 top-0 w-full mx-auto rounded-lg opacity-0" loading="lazy" />
    </a>
    <a href="{{ route('anime.show', $anime['mal_id']) }}" class="my-1">
        <h4 class="p-1 text-lg font-semibold leading-tight text-center transition-colors duration-200 group-hover:text-blue-700 dark:group-hover:text-blue-300">
            {{ $anime['title'] }}
        </h4>
    </a>
    <div class="grid items-center justify-center grid-cols-2 py-1 text-center">
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.user-solid class="w-5 h-5" />
            <span>{{ $anime['members'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            @if ($anime['score'] > 0)
            <x-icons.star-solid class="w-5 h-5" />
            <span>{{ $anime['score'] }}</span>
            @else
            <x-icons.calendar-solid class="w-5 h-5" />
            <span>{{ $anime['start_date'] }}</span>
            @endif
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.video-camera-solid class="w-5 h-5" />
            <span>{{ $anime['type'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
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