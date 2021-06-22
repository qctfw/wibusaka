<div x-data="{ searchOpen: false }" @click.away="searchOpen = false" class="relative w-full px-2 mt-3 md:mt-0">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="w-full px-4 py-1 pl-8 text-sm bg-gray-300 rounded-full dark:bg-gray-900 focus:outline-none focus:ring focus:border-blue-300"
        placeholder="Cari..."
        @focus="searchOpen = true"
        @keydown="searchOpen = true"
        @keydown.escape.window="searchOpen = false"
        @keydown.shift.tab="searchOpen = false"
    />
    <div class="absolute top-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-gray-500 dark:text-white mt-1.5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
    <div x-show="searchOpen" class="absolute left-0 z-40 w-full mt-2 bg-gray-300 rounded-lg dark:bg-gray-800">
        <div class="grid grid-cols-1 overflow-y-auto border border-gray-400 divide-y-2 divide-gray-100 rounded-lg shadow-md min-h-8 max-h-96 divide-solid scrollbar dark:border-gray-700 md:shadow-lg scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700 dark:divide-gray-700">
            <div wire:loading class="w-full h-auto">
                <div class="flex items-center justify-center h-10 gap-4">
                    <svg class="animate-spin block h-5 w-5 text-gray-800 dark:text-gray-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mencari...
                </div>
            </div>
            @if(strlen($search) < 3)
                <div wire:loading.remove class="flex items-center justify-center h-10">
                    <p class="text-sm">Silahkan cari anime disini</p>
                </div>
            @else
                @if ($results->count() > 0)
                    
                    @foreach ($results as $anime)
                    <a
                        href="{{ route('anime.show', $anime['mal_id']) }}"
                        @if ($loop->last) @keydown.tab="searchOpen = false" @endif
                        class="flex flex-row items-center justify-between p-3 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600"
                        wire:loading.remove
                    >
                        <img src="{{ $anime['image_url'] }}" alt="" class="w-12">
                        <div class="grid flex-auto grid-cols-1 ml-3 text-xs">
                            <div class="text-sm font-semibold">
                                {{ $anime['title'] }}
                            </div>
                            <div class="flex flex-row items-center justify-center gap-1 pt-2 text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <p class="flex-auto">{{ $anime['score'] }}</p>
                            </div>
                            <div class="flex flex-row items-center justify-center gap-1 text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                </svg>
                                <p class="flex-auto">{{ $anime['type'] }}{{ ($anime['episodes'] > 1) ? ' ('.$anime['episodes'].' ep)' : '' }}</p>
                            </div>
                            <div class="flex flex-row items-center justify-center gap-1 text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                <p class="flex-auto">
                                    {{ $anime['start_date'] }}
                                </p>
                            </div>
                        </div>
                        <div class="flex-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                            </svg>
                        </div>
                    </a>
                    @endforeach
                @else
                    <div wire:loading.remove class="flex items-center justify-center h-10">
                        <p class="text-sm">Tidak ada hasil untuk "{{ $search }}".</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>