<x-app-layout>
    <x-slot name="title">{{ $anime['title'] }}</x-slot>

    <div class="container flex flex-col px-4 py-4 mx-auto md:pt-12 md:flex-row">
        <div class="grid justify-between flex-none w-full grid-cols-2 md:grid-cols-1 md:items-center md:w-72 md:h-full">
            <div class="w-full text-center">
                <img src="{{ $anime['image_url'] }}" alt="'{{ $anime['title'] }}' anime poster" class="w-64 mx-auto">
                <div class="grid w-auto grid-cols-2 py-2 my-3 bg-gray-200 rounded-xl dark:bg-gray-900">
                    <div class="text-center">
                        <span class="text-lg font-semibold md:text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-3 h-3 md:w-5 md:h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            {{ !empty($anime['score']) ? number_format($anime['score'], 2, '.', '') : 'N/A' }}
                        </span>
                        <p class="text-sm md:text-md">Skor</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-semibold md:text-2xl">#{{ $anime['popularity'] }}</p>
                        <p class="text-sm md:text-md">Terpopuler</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-semibold md:text-2xl">{{ $anime['members'] }}</p>
                        <p class="hidden text-sm md:block">Jumlah Penonton</p>
                        <p class="text-sm md:hidden">Penonton</p>
                    </div>
                    <div class="text-center">
                        <div class="flex flex-row items-center justify-center md:gap-1">
                            <p class="text-lg font-semibold md:text-2xl">{{ $anime['rating']['rating'] ?? 'N/A' }}</p>
                            @if (!empty($anime['rating']['note']))
                            <div class="relative flex flex-col items-center mt-1 group">
                                @if (in_array($anime['rating']['rating'], ['R', 'R+', 'Rx']))
                                <svg xmlns="http://www.w3.org/2000/svg" class="hidden w-6 h-6 md:block" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="hidden w-4 h-4 md:block" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                @endif
                                <div class="absolute bottom-0 flex-col items-center hidden w-48 mb-6 group-hover:flex">
                                    <div class="relative z-20 p-2 text-sm leading-4 text-white whitespace-no-wrap bg-black shadow-xl rounded-xl">
                                        {{ $anime['rating']['note'] }}
                                    </div>
                                    <div class="w-3 h-3 -mt-2 transform rotate-45 bg-black"></div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <p class="text-sm md:text-md">Rating</p>
                    </div>
                </div>
                <x-button-link :link="$anime['url']" class="h-16">
                    <p class="text-lg text-left font-semibold md:text-xl">MyAnimeList</p>
                </x-button-link>
            </div>
            <div class="grid grid-cols-1 pl-2 border-gray-400 border-opacity-50 border-dashed md:mt-3 md:border-t">
                <div class="pb-2 border-b border-gray-400 border-opacity-50 border-dashed md:hidden">
                    <h2 class="text-lg font-bold">{{ $anime['title'] }}</h2>
                    <p class="text-sm italic">{{ $anime['title_english'] }}</p>
                    <p class="text-sm italic">{{ $anime['title_japanese'] }}</p>
                </div>
                <div class="hidden pt-2 md:block">
                    <p class="text-lg font-semibold">Judul Lain</p>
                    <p class="text-sm md:text-md">{{ (count($anime['title_synonyms']) > 0) ? implode(', ', $anime['title_synonyms']) : '-' }}</p>
                </div>
                <div class="pt-2">
                    <p class="font-semibold md:text-lg">Tipe Anime</p>
                    <p class="text-sm md:text-md">
                        {{ $anime['type'] }} @if ($anime['episodes'] > 1) ({{ $anime['episodes'] }} episode) @endif
                    </p>
                </div>
                <div class="pt-2">
                    <p class="font-semibold md:text-lg">Status</p>
                    <p class="text-sm md:text-md">{{ $anime['status'] }}</p>
                </div>
                <div class="pt-2">
                    <p class="font-semibold md:text-lg">Tanggal Tayang</p>
                    <p class="text-sm md:text-md">{{ $anime['aired']['from'] }}@if ($anime['episodes'] > 1 || $anime['airing']) s.d {{ $anime['aired']['to'] }}@endif</p>
                    <p class="text-xs">{{ !empty($anime['premiered']) ? '(' . $anime['premiered'] . ')' : '' }}</p>
                </div>
                <div class="pt-2">
                    <p class="font-semibold md:text-lg">Studio</p>
                    <p class="text-sm md:text-md">
                        @if (count($anime['studios']) <= 0) - @endif
                        @foreach ($anime['studios'] as $studio)
                            {{ $studio['name'] }}{{ (!$loop->last) ? ', ' : '' }}
                        @endforeach
                    </p>
                </div>
                <div class="pt-2">
                    <p class="font-semibold md:text-lg">Sumber</p>
                    <p class="text-sm md:text-md">{{ $anime['source'] }}</p>
                </div>
                <div class="pt-2">
                    <div class="font-semibold md:text-lg">Genre</div>
                    <p class="text-sm md:text-md">
                        @foreach ($anime['genres'] as $genre)
                            {{ $genre['name'] }}{{ (!$loop->last) ? ', ' : '' }}
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        @if (!empty($anime['rating']['note']) && in_array($anime['rating']['rating'], ['R', 'R+', 'Rx']))
        <div class="flex flex-col items-center w-auto gap-2 p-2 my-4 bg-gray-200 md:hidden rounded-xl dark:bg-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm text-center">{{ $anime['rating']['note'] }}</p>
        </div>
        @endif

        <div class="flex-grow md:ml-12">
            <h2 class="hidden text-3xl font-bold text-left md:block lg:text-5xl">{{ $anime['title'] }}</h2>
            <p class="hidden pt-2 text-sm italic text-left md:block">{{ $anime['title_english'] }} / {{ $anime['title_japanese'] }}</p>

            <h3 class="py-3 text-2xl font-semibold border-b border-gray-400 border-opacity-50 border-dashed">Sinopsis</h3>
            <div class="mt-3">
                @if (!empty($anime['synopsis'])) {{ $anime['synopsis'] }} @else <i>Tidak ada sinopsis.</i> @endif
            </div>

            @if (!empty($anime['related']))
            <h3 class="py-3 text-2xl font-semibold border-b border-gray-400 border-opacity-50 border-dashed">Anime Terkait</h3>
            <table class="w-full mt-4 table-fixed">
                <thead>
                    <tr>
                        <th class="w-1/4 lg:w-1/6"></th>
                        <th class="w-auto"></th>
                        <th class="w-3/4 lg:w-5/6"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anime['related'] as $key => $relate)
                    <tr class="border-b border-gray-400 border-dashed border-opacity-30">
                        <td class="font-semibold align-top">
                            {{ ucwords($key) }}
                        </td>
                        <td class="align-top">:</td>
                        <td class="pl-2 align-top">
                        @foreach ($relate as $mal)
                            <a href="{{ ($mal['type'] == 'anime') ? route('anime.show', ['id' => $mal['mal_id']]) : $mal['url'] }}" class="transition-colors duration-200 hover:text-blue-700 dark:hover:text-blue-300">{{ $mal['name'] }}</a>{{ (!$loop->last) ? ', ' : '' }}
                        @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            @if ($anime['status'] != 'Belum Tayang')
            <div class="flex flex-col mt-4">
                <h3 class="pb-3 text-2xl font-semibold border-b border-gray-400 border-opacity-50 border-dashed">Tonton Di</h3>
                <livewire:availability-grid :mal="$anime['mal_id']" />
            </div>
            @endif

            @if (count($anime['opening_themes']) > 0 && count($anime['ending_themes']) > 0)
            <h3 class="py-3 text-2xl font-semibold border-b border-gray-400 border-opacity-50 border-dashed">Tema Lagu</h3>
            <div class="grid justify-between grid-cols-1 md:grid-cols-2">
                <div class="mt-3">
                    <h4 class="text-lg font-semibold">Pembuka</h4>
                    <p class="mt-1">
                        {!! implode('<br />', $anime['opening_themes']) !!}
                    </p>
                </div>
                <div class="mt-3">
                    <h4 class="text-lg font-semibold">Penutup</h4>
                    <p class="mt-1">
                        {!! implode('<br />', $anime['ending_themes']) !!}
                    </p>
                </div>
            </div>
            @endif

            <div class="flex flex-col mt-4">
                <h3 class="py-3 text-2xl font-semibold border-b border-gray-400 border-opacity-50 border-dashed">Rekomendasi</h3>
                <livewire:recommendation-list :mal="$anime['mal_id']" />
            </div>
        </div>
    </div>
</x-app-layout>