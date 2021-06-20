<x-app-layout>
    <x-slot name="title">{{ $anime['title'] }}</x-slot>

    <div class="container flex flex-col px-4 pt-12 mx-auto md:flex-row">
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
                        <p class="text-lg font-semibold md:text-2xl">{{ $anime['rating'] ?? 'N/A' }}</p>
                        <p class="text-sm md:text-md">Rating</p>
                    </div>
                </div>
                <a href="{{ $anime['url'] }}" class="flex items-center justify-between w-full h-16 mt-4 transition-colors duration-200 bg-gray-200 rounded-xl dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700">
                    <div class="flex-auto pl-4">
                        <p class="text-lg font-semibold md:text-xl">MyAnimeList</p>
                    </div>
                    <div class="flex-none pr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                        </svg>
                    </div>
                </a>
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
                    <p class="font-semibold md:text-lg">Jumlah Episode</p>
                    <p class="text-sm md:text-md">{{ $anime['episodes'] ?? '?' }}</p>
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

            <div class="flex flex-col mt-4">
                <h3 class="pb-3 text-2xl font-semibold border-b border-gray-400 border-opacity-50 border-dashed">Tonton Di</h3>
                <livewire:availability-grid :mal="$anime['mal_id']" />
            </div>

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
        </div>
    </div>
</x-app-layout>