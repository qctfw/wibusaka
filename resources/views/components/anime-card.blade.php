<div class="relative flex bg-gray-200 dark:bg-gray-900 rounded-xl p-0 mt-8">
    <img class="w-40 md:w-44 h-auto rounded-l-xl bg-gray-900" src="{{ $anime['image_url'] }}" loading="lazy" alt="Anime Name">
    <div class="grid grid-cols-1 p-2 md:p-3 w-full h-64">
        <div class="relative overflow-y-auto h-auto scrollbar scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
            <a href="{{ route('anime.show', ['id' => $anime['mal_id']]) }}">
                <h3 class="text-lg text-center font-semibold pb-0 transition-colors duration-200 hover:text-blue-300">{{ $anime['title'] }}</h3>
            </a>
            <div class="grid grid-cols-2 text-sm text-center border-b border-dashed border-gray-700 pb-2">
                <div class="pt-1">
                    @foreach ($anime['producers'] as $producer)
                        {{ $producer['name'] . PHP_EOL }}
                    @endforeach
                </div>
                <div class="pt-1">{{ !is_null($anime['score']) ? number_format($anime['score'], 2) : '?.??' }}</div>
                <div class="pt-1 block lg:hidden">{{ $anime['episodes'] ?? '?' }} ep</div>
                <div class="pt-1 hidden lg:block">{{ $anime['episodes'] ?? '?' }} episode</div>
                <div class="pt-1">{{ $anime['source'] }}</div>
            </div>
            <div class="text-sm text-center border-b border-dashed border-gray-700 py-2">
                @foreach ($anime['genres'] as $genre)
                        {{ $genre['name'] . ', ' }}
                @endforeach
            </div>
            <p class="text-xs pt-2 pb-2">
                {{ $anime['synopsis'] }}
            </p>
            
        </div>
    </div>
    @if (rand(1,2) == 1)
        <div class="absolute flex flex-row items-center justify-start gap-2 text-sm bottom-0 left-0 bg-gray-200 bg-opacity-60 dark:bg-gray-900 dark:bg-opacity-50 rounded-bl-lg rounded-tr-lg text-sm px-2 py-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>Tersedia</span>
        </div>    
    @else
        <div class="absolute flex flex-row items-center justify-start gap-2 text-sm bottom-0 left-0 bg-gray-200 bg-opacity-60 dark:bg-gray-900 dark:bg-opacity-50 rounded-bl-lg rounded-tr-lg text-sm px-2 py-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span>Tidak Tersedia</span>
        </div>
    @endif
</div>