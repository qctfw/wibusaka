<div x-data="{ searchOpen: false }" @click.away="searchOpen = false" class="w-full mt-3 md:mt-0">
    <div class="relative">
        <input
        wire:model.debounce.500ms="search"
        type="text"
        class="w-full h-12 px-4 py-1 pl-8 text-lg bg-green-100 bg-opacity-50 rounded-md dark:bg-green-800 focus:outline-none focus:ring focus:ring-green-300"
        placeholder="Cari..."
        @focus="searchOpen = true"
        @keydown="searchOpen = true"
        @keydown.escape.window="searchOpen = false"
        @keydown.shift.tab="searchOpen = false"
        />
        <div class="absolute inset-y-0 flex items-center justify-center left-2">
            <x-icons.search class="w-4" />
        </div>
    </div>
    <div class="flex flex-col h-48 pt-2">
        <div wire:loading class="w-full h-auto">
            <div class="flex items-center justify-center h-10 gap-4">
                <x-icons.spinner class="block w-5 h-5" />
                {{ __('anime.search.loading') }}
            </div>
        </div>
        @if ($results->count() > 0)
        <x-library-scroll wire:loading.remove class="w-full">
            @foreach ($results as $anime)
            <div class="flex flex-col flex-shrink-0 text-green-900 bg-gray-100 divide-y divide-gray-400 rounded-lg w-44 md:w-48 xl:w-48 snap-center group dark:bg-gray-800 dark:text-gray-50 divide-opacity-50 divide-dashed">
                <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="relative flex items-center w-full mx-auto rounded-lg font-primary h-60 md:h-64 lg:h-64 xl:h-64">
                    <img alt="{{ $anime['title'] }} Anime Poster" src="{{ $anime['image_url'] }}" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto rounded-lg" loading="lazy" />
                    <div class="absolute inset-x-0 bottom-0 py-1 bg-black bg-opacity-50">
                        <h4 class="p-1 text-lg font-semibold leading-tight text-center text-green-100 transition-colors duration-200 group-hover:text-green-300 dark:group-hover:text-green-300">
                            {{ $anime['title'] }}
                        </h4>
                    </div>
                </a>

                @if (!empty($resources[$anime['mal_id']]))
                <div class="flex flex-row items-center justify-center gap-3 py-1 text-sm text-center">
                    @forelse ($resources[$anime['mal_id']] as $resource)
                    <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6" title="{{ $resource->alternative_note }}">
                        <img src="{{ logo_asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
                    </a>
                    @empty
                    <x-icons.x class="w-6 h-6" />
                    <span>{{ __('anime.single.availability_empty_short') }}</span>
                    @endforelse
                </div>
                @endif
            </div>
            @endforeach
        </x-library-scroll>
        @endif
    </div>
    {{-- <div x-show="searchOpen" class="absolute left-0 z-40 w-full mt-2 bg-green-900 rounded-lg text-green-50 dark:bg-gray-800">
        <div class="grid grid-cols-1 overflow-y-auto border border-green-400 divide-y-2 divide-green-800 rounded-lg shadow-md min-h-8 max-h-96 divide-solid scrollbar-extra-thin dark:border-gray-700 md:shadow-lg scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700 dark:divide-gray-700">
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
                        class="flex flex-row items-center justify-between p-3 transition-colors rounded-lg hover:text-green-900 hover:bg-green-300 dark:hover:text-green-50 dark:hover:bg-green-800"
                        wire:loading.remove
                    >
                        <img src="{{ $anime['image_url'] }}" alt="" class="w-12">
                        <div class="grid flex-auto grid-cols-1 ml-3 text-xs">
                            <div class="text-sm font-semibold font-primary">
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
                        <p class="text-sm">{{ __('anime.search.no_results', ['query' => $search]) }}</p>
                    </div>
                @endif
            @endif
        </div>
    </div> --}}
</div>