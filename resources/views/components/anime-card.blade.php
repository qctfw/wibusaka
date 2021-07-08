<div class="relative flex flex-col py-1 mt-4 bg-gray-200 divide-y divide-gray-400 divide-opacity-50 divide-dashed dark:bg-gray-900 rounded-xl">
    <a href="{{ route('anime.show', $anime['mal_id']) }}" class="p-1 text-lg leading-tight font-semibold text-center transition-colors duration-200 hover:text-blue-700 dark:hover:text-blue-300">{{ $anime['title'] }}</a>
    <div class="flex flex-row items-start justify-center gap-4 py-1 text-sm">
        <div class="flex flex-col text-center">
            @forelse ($anime['producers'] as $producer)
                <p>{{ $producer['name'] }}</p>
            @empty
                <p>-</p>
            @endforelse
        </div>
        <span>&bull;</span>
        <div class="text-center">{{ $anime['episodes'] ?? '?' }} ep</div>
        <span>&bull;</span>
        <div class="text-center">{{ $anime['source'] }}</div>
    </div>
    <div class="flex flex-row flex-wrap justify-center gap-2 p-1 text-xs">
        @foreach ($anime['genres'] as $genre)
        <a href="{{ route('anime.genre.show', str_replace(' ', '-', strtolower($genre['name']))) }}" class="px-2 bg-gray-300 rounded-lg transition-colors dark:bg-gray-800 dark:hover:bg-gray-700">{{ $genre['name'] }}</a>
        @endforeach
    </div>
    <div class="grid grid-cols-2 h-72 md:h-64 lg:h-80">
        <a href="{{ route('anime.show', $anime['mal_id']) }}" class="mx-auto h-72 md:h-64 lg:h-80">
            <img class="max-w-full max-h-full" src="{{ $anime['image_url'] }}" loading="lazy" alt="Anime Name">
        </a>
        <div class="px-1 mt-1 overflow-y-auto scrollbar scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
            <p class="text-sm">{{ $anime['synopsis'] }}</p>
        </div>
    </div>
    <div class="relative flex flex-row items-center justify-between px-2 py-1">
        @if ($resources->count() > 0)
        <div class="absolute inset-x-0 -top-8 flex flex-row items-center justify-center w-1/2 gap-3 bg-gray-900 bg-opacity-60 py-1">
            @foreach ($resources as $resource)
            <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6">
                <img src="{{ asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
            </a>
            @endforeach
        </div>
        @endif
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.video-camera-solid class="w-5 h-5" />
            <span>{{ $anime['type'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.calendar-solid class="w-5 h-5" />
            <span>{{ $anime['airing_start'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.star-solid class="w-5 h-5" />
            <span>{{ $anime['score'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <x-icons.user-solid class="w-5 h-5" />
            <span>{{ $anime['members'] }}</span>
        </div>
    </div>
</div>
