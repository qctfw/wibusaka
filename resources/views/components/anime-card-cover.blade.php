<div class="flex flex-col bg-gray-200 rounded-lg group dark:bg-gray-900 divide-y divide-gray-400 divide-opacity-50 divide-dashed">
    <a href="{{ route('anime.show', $anime['mal_id']) }}" class="w-full mx-auto rounded-lg">
        <img src="{{ $anime['image_url'] }}" alt="{{ $anime['title'] }} Anime Poster" class="w-full mx-auto rounded-lg" loading="lazy" />
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
            <img src="{{ asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
        </a>
        @empty
        <x-icons.x class="w-6 h-6" />
        <span>Tidak Tersedia</span>
        @endforelse
    </div>
    @endif
</div>