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
        <x-icons.search class="w-4 mt-1.5 ml-2" />
    </div>
    <div x-show="searchOpen" class="absolute left-0 z-40 w-full mt-2 bg-gray-300 rounded-lg dark:bg-gray-800">
        <div class="grid grid-cols-1 overflow-y-auto border border-gray-400 divide-y-2 divide-gray-100 rounded-lg shadow-md min-h-8 max-h-96 divide-solid scrollbar-extra-thin dark:border-gray-700 md:shadow-lg scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700 dark:divide-gray-700">
            <div wire:loading class="w-full h-auto">
                <div class="flex items-center justify-center h-10 gap-4">
                    <x-icons.spinner class="block w-5 h-5" />
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
                                <x-icons.star-solid class="flex-none w-4 h-4" />
                                <p class="flex-auto">{{ $anime['score'] }}</p>
                            </div>
                            <div class="flex flex-row items-center justify-center gap-1 text-left">
                                <x-icons.video-camera-solid class="flex-none w-4 h-4" />
                                <p class="flex-auto">{{ $anime['type'] }}{{ ($anime['episodes'] > 1) ? ' ('.$anime['episodes'].' ep)' : '' }}</p>
                            </div>
                            <div class="flex flex-row items-center justify-center gap-1 text-left">
                                <x-icons.calendar-solid class="flex-none w-4 h-4" />
                                <p class="flex-auto">
                                    {{ $anime['start_date'] }}
                                </p>
                            </div>
                        </div>
                        <div class="flex-none">
                            <x-icons.external-link-solid class="w-5 h-5" />
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