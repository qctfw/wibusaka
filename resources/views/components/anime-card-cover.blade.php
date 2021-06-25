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
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span>{{ $anime['members'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            @if ($anime['score'] > 0)
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <span>{{ $anime['score'] }}</span>
            @else
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            <span>{{ $anime['start_date'] }}</span>
            @endif
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
            </svg>
            <span>{{ $anime['type'] }}</span>
        </div>
        <div class="flex flex-row items-center justify-center gap-2 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
            </svg>
            <span>{{ $anime['episodes'] ?? '?' }} ep</span>
        </div>
    </div>

    @if (!is_null($resources))
    <div class="flex flex-row items-center justify-center gap-3 py-1 text-sm text-center">
        @forelse ($resources as $resource)
        <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6">
            <img src="{{ asset($resource->platform->icon_url) }}" alt="{{ $resource->platform->name }} Logo" />
        </a>
        @empty
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span>Tidak Tersedia</span>
        @endforelse
    </div>
    @endif
</div>