<div class="relative flex items-start p-0 mt-8 bg-gray-200 dark:bg-gray-900 rounded-xl">
    <img class="w-40 h-auto bg-gray-900 md:w-44 rounded-l-xl" src="{{ $anime['image_url'] }}" loading="lazy" alt="Anime Name">
    <div class="grid w-full h-64 grid-cols-1 p-2 md:p-3">
        <div class="relative h-auto overflow-y-auto scrollbar scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
            <a href="{{ route('anime.show', $anime['mal_id']) }}">
                <h3 class="pb-0 text-lg font-semibold text-center transition-colors duration-200 hover:text-blue-700 dark:hover:text-blue-300">{{ $anime['title'] }}</h3>
            </a>
            <div class="grid grid-cols-2 pb-2 text-sm text-center border-b border-gray-700 border-dashed">
                <div class="pt-1">
                    @foreach ($anime['producers'] as $producer)
                        {{ $producer['name'] . PHP_EOL }}
                    @endforeach
                </div>
                <div class="pt-1">{{ !is_null($anime['score']) ? number_format($anime['score'], 2) : '?.??' }}</div>
                <div class="block pt-1 lg:hidden">{{ $anime['episodes'] ?? '?' }} ep</div>
                <div class="hidden pt-1 lg:block">{{ $anime['episodes'] ?? '?' }} episode</div>
                <div class="pt-1">{{ $anime['source'] }}</div>
            </div>
            <div class="py-2 text-sm text-center border-b border-gray-700 border-dashed">
                @foreach ($anime['genres'] as $genre)
                    {{ $genre['name'] }}{{ (!$loop->last) ? ', ' : '' }}
                @endforeach
            </div>
            <p class="pt-2 pb-2 text-xs">
                {{ $anime['synopsis'] }}
            </p>
            
        </div>
    </div>
    @if (rand(1,2) == 1)
        <div class="absolute bottom-0 left-0 flex flex-row items-center justify-start gap-2 px-2 py-1 text-sm bg-gray-200 rounded-tr-lg rounded-bl-lg bg-opacity-60 dark:bg-gray-900 dark:bg-opacity-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>Tersedia</span>
        </div>    
    @else
        <div class="absolute bottom-0 left-0 flex flex-row items-center justify-start gap-2 px-2 py-1 text-sm bg-gray-200 rounded-tr-lg rounded-bl-lg bg-opacity-60 dark:bg-gray-900 dark:bg-opacity-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span>Tidak Tersedia</span>
        </div>
    @endif
</div>