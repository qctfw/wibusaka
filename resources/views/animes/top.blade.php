<x-app-layout>
    <x-slot name="title">Top Anime</x-slot>

    <div class="container mx-auto px-4 pt-12">
        <h2 class="uppercase tracking-wider text-blue-300 text-lg font-semibold">Top Anime</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 py-4">
            @for ($i=0;$i<10;$i++)
            <div class="flex flex-col bg-gray-200 dark:bg-gray-900 rounded-lg">
                <a href="anime" class="w-full mx-auto rounded-lg">
                    <img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx104578-LaZYFkmhinfB.jpg" alt="Single Anime" class="w-full mx-auto rounded-lg" />
                </a>
                <a href="anime">
                    <h4 class="text-lg text-center leading-tight font-semibold py-1 border-b border-dashed border-gray-400 border-opacity-50">
                        Attack on Titan
                    </h4>
                </a>
                <div class="grid grid-cols-2 items-center justify-center text-center py-1 border-b border-dashed border-gray-400 border-opacity-50">
                    <div class="flex flex-row text-center items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <span>1.15 jt</span>
                    </div>
                    <div class="flex flex-row text-center items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span>9.00</span>
                    </div>
                    <div class="flex flex-row text-center items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                        </svg>
                        <span>PG-13</span>
                    </div>
                    <div class="flex flex-row text-center items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                        </svg>
                        <span>99999 ep</span>
                    </div>
                </div>
                <div class="flex flex-row text-center items-center justify-center gap-2 text-sm py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Tersedia</span>
                </div>
            </div>
            @endfor
        </div>
        <h2 class="uppercase tracking-wider text-blue-300 text-lg font-semibold pt-12">Anime Paling Dinantikan</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 py-4">
            @for ($i=0;$i<10;$i++)
            <div class="flex flex-col bg-gray-200 dark:bg-gray-900 rounded-lg">
                <a href="anime" class="w-full mx-auto rounded-lg">
                    <img src="https://cdn.myanimelist.net/images/anime/1245/111800.jpg?s=7302aaeb3bc4e1433b32d094e9d6f6f0" alt="Single Anime" class="w-full mx-auto rounded-lg" />
                </a>
                <a href="anime">
                    <h4 class="text-lg text-center font-semibold leading-tight py-1 border-b border-dashed border-gray-400 border-opacity-50">
                        Tate no Yuusha no Nariagari Season 2
                    </h4>
                </a>
                <div class="grid grid-cols-2 items-center justify-center text-center py-1 border-b border-dashed border-gray-400 border-opacity-50">
                    <div class="flex flex-row text-center items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <span>281 rb</span>
                    </div>
                    <div class="flex flex-row text-center items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        <span>1 Okt 2021</span>
                    </div>
                    <div class="flex flex-row text-center items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                        </svg>
                        <span>PG-13</span>
                    </div>
                    <div class="flex flex-row text-center items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                        </svg>
                        <span>99999 ep</span>
                    </div>
                </div>
                <div class="flex flex-row text-center items-center justify-center gap-2 text-sm py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Tersedia</span>
                </div>
            </div>
            @endfor
        </div>
    </div>
</x-app-layout>