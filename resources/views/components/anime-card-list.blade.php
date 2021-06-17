<div class="relative flex flex-col items-center justify-between p-2 bg-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 md:static md:flex-row dark:bg-gray-900 md:h-auto">
    <div class="absolute top-0 left-0 w-auto px-2 text-xl text-center bg-gray-200 rounded-lg md:bg-transparent md:static md:block md:flex-none md:w-12 md:px-0 dark:bg-gray-900 md:rounded-none md:text-2xl md:font-bold">
        #{{ $anime['rank'] }}
    </div>
    <a href="{{ route('anime.show', ['id' => $anime['mal_id']]) }}" class="flex flex-row items-center w-full md:w-20 md:pl-4">
        <img src="{{ $anime['image_url'] }}" alt="'{{ $anime['title'] }}' Anime Poster" loading="lazy" class="mx-auto" />
    </a>
    <div class="grid items-center w-full grid-cols-1 pb-2 border-b border-gray-400 border-opacity-50 border-dashed md:items-baseline md:flex md:flex-auto md:flex-col md:ml-3 md:border-none md:pb-0">
        <a href="{{ route('anime.show', ['id' => $anime['mal_id']]) }}" class="flex flex-row items-center justify-center py-2 text-lg font-semibold text-center transition-colors duration-200 border-b border-gray-400 border-opacity-50 border-dashed md:text-left md:py-0 md:border-none hover:text-blue-700 dark:hover:text-blue-300">
            {{ $anime['title'] }}
        </a>
        <div class="flex flex-row items-center justify-center gap-0 pt-2 text-center md:gap-2 md:text-left text-md md:text-sm md:pt-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
            </svg>
            <p class="flex-auto">{{ $anime['type'] }}{{ ($anime['episodes'] > 1) ? ' ('.$anime['episodes'].' ep)' : '' }}</p>
        </div>
        <div class="flex flex-row items-center justify-center gap-0 text-center md:gap-2 md:text-left text-md md:text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            <p class="flex-auto">
                {{ $anime['start_date'] ?? '-' }}
                @if (!is_null($anime['end_date']) && $anime['start_date'] != $anime['end_date'])
                <span class="hidden md:inline"> - {{ $anime['end_date'] }}</span>
                @endif
            </p>
        </div>
        <div class="flex flex-row items-center justify-center gap-0 text-center md:gap-2 md:text-left text-md md:text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <p class="flex-auto">{{ $anime['members'] }}</p>
        </div>
    </div>
    <div class="grid flex-none grid-cols-1 md:grid-cols-2">
        <div class="flex-row items-center justify-center hidden mx-4 md:flex">
            <div class="flex flex-row items-center justify-center gap-2 py-1 text-sm text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Tersedia</span>
            </div>
        </div>
        <div class="{{ ($anime['score'] == 'N/A') ? 'hidden md:flex' : 'flex'}} flex-row items-center justify-center pt-2 md:pt-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 pr-1" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <span class="text-xl font-semibold">{{ $anime['score'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center mx-4">
            <div class="flex flex-row items-center justify-center gap-2 pt-2 text-sm text-center md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Tersedia</span>
            </div>
        </div>
    </div>
</div>