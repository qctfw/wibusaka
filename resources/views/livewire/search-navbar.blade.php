<div x-data="{ searchOpen: false }" @click.away="searchOpen = false" class="relative w-full px-2 mt-3 md:mt-0">
    <input
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
        <div class="grid h-64 grid-cols-1 overflow-y-auto border border-gray-400 divide-y-2 divide-gray-100 rounded-lg shadow-md divide-solid scrollbar dark:border-gray-700 md:shadow-lg scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700 dark:divide-gray-700">
            @for ($i = 1; $i <= 6; $i++)
            <a href="#" @if ($i==6) @keydown.tab="searchOpen = false" @endif class="flex flex-row items-center justify-between p-3 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-600">
                <img src="https://cdn.myanimelist.net/images/anime/9/9453.jpg" alt="" class="w-12">
                <div class="grid flex-auto grid-cols-1 ml-3 text-xs">
                    <div class="text-sm font-semibold">
                        Death Note {{ $i }}
                    </div>
                    <div class="flex flex-row items-center justify-center gap-1 pt-2 text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <p class="flex-auto">8.99</p>
                    </div>
                    <div class="flex flex-row items-center justify-center gap-1 text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                        </svg>
                        <p class="flex-auto">TV (25 ep)</p>
                        {{-- <p class="flex-auto">{{ $anime['type'] }}{{ ($anime['episodes'] > 1) ? ' ('.$anime['episodes'].' ep)' : '' }}</p> --}}
                    </div>
                    <div class="flex flex-row items-center justify-center gap-1 text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-none w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        <p class="flex-auto">
                            Apr 2020
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
            @endfor
        </div>
    </div>
</div>