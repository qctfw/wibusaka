<div wire:init="loadRecommendations" class="grid items-start justify-between grid-cols-3 gap-2 mt-4 md:grid-cols-5">
    @if ($loaded)
        @forelse ($recommendations as $anime)
        <div class="relative group flex flex-col bg-gray-200 rounded-lg dark:bg-gray-900">
            <div class="absolute top-0 left-0 flex flex-row items-center w-auto gap-1 px-2 text-center bg-gray-200 rounded-tl-lg rounded-br-lg text-md dark:bg-gray-900">
                <span>{{ $anime['recommendation_count'] }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
            </div>
            <a href="{{ route('anime.show', ['id' => $anime['mal_id']]) }}" class="w-full mx-auto rounded-lg">
                <img src="{{ $anime['image_url'] }}" alt="{{ $anime['title'] }} Anime Poster" class="w-full mx-auto rounded-lg" loading="lazy" />
            </a>
            <a href="{{ route('anime.show', ['id' => $anime['mal_id']]) }}">
                <p class="py-1 text-md font-semibold leading-tight text-center transition-colors duration-200 border-dashed group-hover:text-blue-700 dark:group-hover:text-blue-300">
                    {{ $anime['title'] }}
                </p>
            </a>
        </div>
        @empty
        <div class="flex items-center h-12 col-span-2 p-4">
            <p class="w-full italic text-center">
                Saat ini belum ada rekomendasi yang bisa diberikan dari anime ini.
            </p>
        </div>
            @endforelse
    @else
    <div class="flex items-center justify-center h-12 col-span-2 gap-4">
        <svg class="block w-5 h-5 text-gray-800 animate-spin dark:text-gray-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Memuat...
    </div>
    @endif
</div>