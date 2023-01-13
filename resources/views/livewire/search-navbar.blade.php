<div x-data="{ searchOpen: false }" @click.away="searchOpen = false" class="relative w-full">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="w-full h-7 px-4 py-1 pl-8 text-sm rounded-md bg-emerald-100 {{ request()->routeIs('index') ? 'dark:bg-gray-800' : 'dark:bg-gray-900' }} focus:outline-none focus:ring focus:ring-emerald-300"
        placeholder="Cari..."
        @focus="searchOpen = true"
        @keydown="searchOpen = true"
        @keydown.escape.window="searchOpen = false"
        @keydown.shift.tab="searchOpen = false"
    />
    <div class="absolute inset-y-0 left-2 flex items-center justify-center">
        <x-icons.search class="w-4" />
    </div>
    <div x-show="searchOpen" x-cloak class="absolute left-0 z-40 w-full mt-2 bg-emerald-900 rounded-lg text-emerald-50 dark:bg-gray-800">
        <div class="grid grid-cols-1 overflow-y-auto border border-emerald-400 divide-y-2 divide-emerald-800 rounded-lg shadow-md min-h-8 max-h-96 divide-solid scrollbar-extra-thin dark:border-gray-700 md:shadow-lg scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700 dark:divide-gray-700">
            <div wire:loading class="w-full h-auto">
                <div class="flex items-center justify-center h-10 gap-4">
                    <x-icons.spinner class="block w-5 h-5" />
                    {{ __('anime.search.loading') }}
                </div>
            </div>
            @if(strlen($search) < 3)
                <div wire:loading.remove class="flex items-center justify-center h-10">
                    <p class="text-sm">{{ __('anime.search.placeholder') }}</p>
                </div>
            @else
                @if ($results->count() > 0)

                    @foreach ($results as $anime)
                    <a
                        href="{{ route('anime.show', $anime['mal_id']) }}"
                        rel="nofollow"
                        @if ($loop->last) @keydown.tab="searchOpen = false" @endif
                        class="flex flex-row items-center justify-between p-3 transition-colors rounded-lg hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-emerald-50 dark:hover:bg-emerald-800"
                        wire:loading.remove
                    >
                        <img src="{{ $anime['images']['webp']['small_image_url'] }}" alt="" class="w-12">
                        <div class="grid flex-auto grid-cols-1 ml-3 text-xs">
                            <div class="text-sm font-semibold font-primary">
                                {{ $anime['titles']['default'][0] }}
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
                                    {{ $anime->airedFromFormat('M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex-none">
                            <x-icons.external-link-solid class="w-5 h-5" />
                        </div>
                    </a>
                    @endforeach
                @elseif (strlen($message) > 0)
                    <div wire:loading.remove class="flex items-center justify-center h-20">
                        <p class="text-sm font-normal p-2">{{ $message }}</p>
                    </div>
                @else
                    <div wire:loading.remove class="flex items-center justify-center h-10">
                        <p class="text-sm">{{ __('anime.search.no_results', ['query' => $search]) }}</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
