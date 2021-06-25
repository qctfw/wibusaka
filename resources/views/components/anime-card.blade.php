<div class="relative flex flex-col py-1 mt-4 bg-gray-200 divide-y divide-gray-400 divide-opacity-50 divide-dashed dark:bg-gray-900 rounded-xl">
    <a href="{{ route('anime.show', $anime['mal_id']) }}" class="pb-0 text-lg font-semibold text-center transition-colors duration-200 hover:text-blue-700 dark:hover:text-blue-300">{{ $anime['title'] }}</a>
    <div class="flex flex-row items-start justify-center gap-4 py-1 text-sm">
        <div class="flex flex-col text-center">
            @foreach ($anime['producers'] as $producer)
                <p>{{ $producer['name'] }}</p>
            @endforeach
        </div>
        <span>&bull;</span>
        <div class="text-center">{{ $anime['episodes'] ?? '?' }} ep</div>
        <span>&bull;</span>
        <div class="text-center">{{ $anime['source'] }}</div>
    </div>
    <div class="flex flex-row flex-wrap justify-center gap-2 p-1 text-xs">
        @foreach ($anime['genres'] as $genre)
        <div class="px-2 bg-gray-300 rounded-lg transition-colors dark:bg-gray-800 dark:hover:bg-gray-700">{{ $genre['name'] }}</div>
        @endforeach
    </div>
    <div class="relative grid grid-cols-2 h-72 md:h-64 lg:h-80">
        @if ($resources->count() > 0)
        <div class="absolute inset-x-0 bottom-0 flex flex-row items-center justify-center w-1/2 gap-3 bg-gray-900 bg-opacity-60 py-1">
            @foreach ($resources as $resource)
            <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6">
                <img src="{{ asset($resource->platform->icon_url) }}" alt="{{ $resource->platform->name }} Logo" />
            </a>
            @endforeach
        </div>
        @endif
        <a href="{{ route('anime.show', $anime['mal_id']) }}" class="mx-auto h-72 md:h-64 lg:h-80">
            <img class="max-w-full max-h-full" src="{{ $anime['image_url'] }}" loading="lazy" alt="Anime Name">
        </a>
        <div class="px-1 mt-1 overflow-y-auto scrollbar scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
            <p class="text-sm">{{ $anime['synopsis'] }}</p>
        </div>
    </div>
    <div class="flex flex-row items-center justify-between px-2 py-1">
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
            </svg>
            <span>{{ $anime['type'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            <span>{{ $anime['airing_start'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <span>{{ $anime['score'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span>{{ $anime['members'] }}</span>
        </div>
    </div>
</div>
