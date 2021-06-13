<x-app-layout>
    <x-slot name="title">{{ $anime['title'] }}</x-slot>

    <div class="container mx-auto flex flex-col md:flex-row px-4 pt-12">
        <div class="flex-none grid grid-cols-2 md:grid-cols-1 justify-between md:items-center w-full md:w-72 md:h-full">
            <div class="text-center w-full">
                <img src="{{ $anime['image_url'] }}" alt="'{{ $anime['title'] }}' anime poster" class="w-64 mx-auto">
                <div class="grid grid-cols-2 rounded-xl bg-gray-200 dark:bg-gray-900 w-auto py-2 my-3">
                    <div class="text-center">
                        <span class="text-lg font-semibold md:text-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 md:w-5 md:h-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
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
                        <p class="text-sm hidden md:block">Jumlah Penonton</p>
                        <p class="text-sm md:hidden">Penonton</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-semibold md:text-2xl">{{ $anime['rating'] ?? 'N/A' }}</p>
                        <p class="text-sm md:text-md">Rating</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 pl-2 md:mt-3 md:border-t border-dashed border-gray-400 border-opacity-50">
                <div class="md:hidden pb-2 border-b border-dashed border-gray-400 border-opacity-50">
                    <h2 class="text-lg font-bold">{{ $anime['title'] }}</h2>
                    <p class="text-sm italic">{{ $anime['title_english'] }}</p>
                    <p class="text-sm italic">{{ $anime['title_japanese'] }}</p>
                </div>
                <div class="pt-2 hidden md:block">
                    <p class="text-lg font-semibold">Judul Lain</p>
                    <p class="text-sm md:text-md">{{ (count($anime['title_synonyms']) > 0) ? implode(', ', $anime['title_synonyms']) : '-' }}</p>
                </div>
                <div class="pt-2">
                    <p class="md:text-lg font-semibold">Jumlah Episode</p>
                    <p class="text-sm md:text-md">{{ $anime['episodes'] ?? '?' }}</p>
                </div>
                <div class="pt-2">
                    <p class="md:text-lg font-semibold">Status</p>
                    <p class="text-sm md:text-md">{{ $anime['status'] }}</p>
                </div>
                <div class="pt-2">
                    <p class="md:text-lg font-semibold">Tanggal Tayang</p>
                    <p class="text-sm md:text-md">{{ $anime['aired']['from'] }}@if ($anime['episodes'] > 1 || $anime['airing']) s.d {{ $anime['aired']['to'] }}@endif</p>
                    <p class="text-xs">{{ !empty($anime['premiered']) ? '(' . $anime['premiered'] . ')' : '' }}</p>
                </div>
                <div class="pt-2">
                    <p class="md:text-lg font-semibold">Studio</p>
                    <p class="text-sm md:text-md">
                        @if (count($anime['studios']) <= 0) - @endif
                        @foreach ($anime['studios'] as $studio)
                            {{ $studio['name'] }}{{ (!$loop->last) ? ', ' : '' }}
                        @endforeach
                    </p>
                </div>
                <div class="pt-2">
                    <p class="md:text-lg font-semibold">Sumber</p>
                    <p class="text-sm md:text-md">{{ $anime['source'] }}</p>
                </div>
                <div class="pt-2">
                    <div class="md:text-lg font-semibold">Genre</div>
                    <p class="text-sm md:text-md">
                        @foreach ($anime['genres'] as $genre)
                            {{ $genre['name'] }}{{ (!$loop->last) ? ', ' : '' }}
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        <div class="flex-grow md:ml-12">
            <h2 class="hidden md:block text-3xl lg:text-5xl font-bold text-left">{{ $anime['title'] }}</h2>
            <p class="hidden md:block text-sm italic pt-2 text-left">{{ $anime['title_english'] }} / {{ $anime['title_japanese'] }}</p>

            <h3 class="text-2xl font-semibold border-b border-dashed border-gray-400 border-opacity-50 py-3">Sinopsis</h3>
            <div class="mt-3">
                {{ $anime['synopsis'] }}
            </div>

            <a href="{{ $anime['url'] }}" class="flex justify-between items-center rounded-xl bg-gray-200 dark:bg-gray-900 lg:w-96 h-16 mt-4 transition-colors duration-200 hover:bg-gray-300 dark:hover:bg-gray-700">
                <div class="flex-auto pl-4">
                    <p class="text-xl font-semibold">Lihat lebih lanjut di MyAnimeList</p>
                </div>
                <div class="flex-none pr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                    </svg>
                </div>
            </a>
            @if (!empty($anime['related']))
            <h3 class="text-2xl font-semibold border-b border-dashed border-gray-400 border-opacity-50 py-3">Anime Terkait</h3>
            <table class="table-fixed w-full mt-4">
                <thead>
                    <tr>
                        <th class="w-1/4 lg:w-1/6"></th>
                        <th class="w-auto"></th>
                        <th class="w-3/4 lg:w-5/6"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anime['related'] as $key => $relate)
                    <tr class="border-b border-dashed border-gray-400 border-opacity-30">
                        <td class="font-semibold align-top">
                            {{ ucwords($key) }}
                        </td>
                        <td class="align-top">:</td>
                        <td class="align-top pl-2">
                        @foreach ($relate as $mal)
                            <a href="{{ ($mal['type'] == 'anime') ? route('anime.show', ['id' => $mal['mal_id']]) : $mal['url'] }}" class="transition-colors duration-200 hover:text-blue-300">{{ $mal['name'] }}</a>{{ (!$loop->last) ? ', ' : '' }}
                        @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            <div class="flex flex-col mt-4">
                <h3 class="text-2xl font-semibold border-b border-dashed border-gray-400 border-opacity-50 pb-3">Tonton Di</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 rounded-xl bg-gray-200 dark:bg-gray-900 items-center mt-4">
                    <a href="#" class="flex flex-row items-center justify-between rounded-xl p-4 transition-colors duration-200 hover:bg-gray-300 dark:hover:bg-gray-700">
                        <div class="flex-none">
                            <img src="https://www.iconpacks.net/icons/2/free-youtube-logo-icon-2431-thumb.png" alt="YouTube Icon" class="w-16 h-16">
                        </div>
                        <div class="flex-auto flex flex-col pl-4">
                            <p class="text-lg font-semibold">YouTube</p>
                            <p class="text-sm italic">Hanya tersedia untuk member</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                        </svg>
                    </a>
                    <a href="#" class="flex flex-row items-center justify-between rounded-xl p-4 transition-colors duration-200 hover:bg-gray-300 dark:hover:bg-gray-700">
                        <div class="flex-none">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Cib-crunchyroll_%28CoreUI_Icons_v1.0.0%29_orange.svg/1024px-Cib-crunchyroll_%28CoreUI_Icons_v1.0.0%29_orange.svg.png" alt="Crunchyroll Icon" class="w-16 h-16">
                        </div>
                        <div class="flex-auto flex flex-col pl-4">
                            <p class="text-lg font-semibold">Crunchyroll</p>
                            <p class="text-sm italic">Berbayar, Hanya tersedia takarir Inggris</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                        </svg>
                    </a>
                    <a href="#" class="flex flex-row items-center justify-between rounded-xl p-4 transition-colors duration-200 hover:bg-gray-300 dark:hover:bg-gray-700">
                        <div class="flex-none">
                            <img src="https://cdn.iconscout.com/icon/free/png-512/iqiyi-2270642-1891169.png" alt="iQIYI Icon" class="w-16 h-16">
                        </div>
                        <div class="flex-auto flex flex-col pl-4">
                            <p class="text-lg font-semibold">iQIYI</p>
                            <p class="text-sm italic"></p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                        </svg>
                    </a>
                    <a href="#" class="flex flex-row items-center justify-between rounded-xl p-4 transition-colors duration-200 hover:bg-gray-300 dark:hover:bg-gray-700">
                        <div class="flex-none">
                            <img src="https://play-lh.googleusercontent.com/axmzJq96GZvxoucDaMexANY0UD97-Loj6LJTN0hycbXVj6PySGECoVJcCS3v7Eh-wc0" alt="Sushiroll Icon" class="w-16 h-16">
                        </div>
                        <div class="flex-auto flex flex-col pl-4">
                            <p class="text-lg font-semibold">Sushiroll</p>
                            <p class="text-sm italic">Berbayar</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                        </svg>
                    </a>
                </div>
            </div>

            @if (count($anime['opening_themes']) > 0 && count($anime['ending_themes']) > 0)
            <h3 class="text-2xl font-semibold border-b border-dashed border-gray-400 border-opacity-50 py-3">Tema Lagu</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 justify-between">
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