<x-app-layout>
    <x-slot name="title">Single Anime</x-slot>

    <div class="container mx-auto flex flex-col md:flex-row px-4 pt-12">
        <div class="flex-none grid grid-cols-1 justify-between items-center w-full md:w-72">
            <div class="text-center w-full">
                <img src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx104578-LaZYFkmhinfB.jpg" alt="Poster Anime" class="w-64 mx-auto">
            </div>
            <div class="mt-3 pt-2 border-t border-dashed border-gray-400 border-opacity-50">
                <p class="text-lg font-semibold">Judul Lain</p>
                <p>Attack on Titan, 進撃の巨人</p>
            </div>
            <div class="pt-2">
                <p class="text-lg font-semibold">Status</p>
                <p>Sedang Tayang</p>
                {{-- <p>Akan Tayang</p> --}}
                {{-- <p>Sudah Tayang</p> --}}
            </div>
            <div class="pt-2">
                <p class="text-lg font-semibold">Tanggal Tayang</p>
                <p>1 Juli 2020 s.d 30 September 2020</p>
                <p class="text-xs">(Summer 2020)</p>
            </div>
            <div class="pt-2">
                <p class="text-lg font-semibold">Studio</p>
                <p>MAPPA</p>
            </div>
            <div class="pt-2">
                <p class="text-lg font-semibold">Sumber</p>
                <p>Manga</p>
            </div>
            <div class="pt-2">
                <div class="text-lg font-semibold">Genre</div>
                <p>Action, Military, Mystery, Super Power, Drama, Fantasy, Shounen</p>
            </div>
        </div>

        <div class="md:ml-12 border-t md:border-0 border-dashed border-gray-400 border-opacity-50 mt-3 md:mt-0 pt-2 md:pt-0">
            <h2 class="text-3xl lg:text-5xl font-bold text-center md:text-left">Shingeki no Kyojin</h2>
            <p class="text-sm italic pt-2 text-center md:text-left">Attack on Titan / 進撃の巨人</p>
            
            <div class="flex justify-between items-center rounded-xl bg-gray-200 dark:bg-gray-900 w-auto h-16 my-3">
                <div class="flex-auto text-center">
                    <span class="text-lg md:text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 md:w-5 md:h-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    9.00
                    </span>
                    <p class="text-sm md:text-md">Skor</p>
                </div>
                <div class="flex-auto text-center">
                    <p class="text-lg md:text-2xl">#9</p>
                    <p class="text-sm md:text-md">Terpopuler</p>
                </div>
                <div class="flex-auto text-center">
                    <p class="text-lg md:text-2xl">1.17 jt</p>
                    <p class="text-md hidden md:block">Jumlah Penonton</p>
                    <p class="md:hidden">Penonton</p>
                </div>
                <div class="flex-auto text-center">
                    <p class="text-lg md:text-2xl">R</p>
                    <p class="text-sm md:text-md">Rating</p>
                </div>
            </div>

            <h3 class="text-2xl font-semibold border-b border-dashed border-gray-400 border-opacity-50 pb-4">Sinopsis</h3>
            <div class="mt-3">
                Gabii Braun and Falco Grice have been training their entire lives to inherit one of the seven titans under Marley's control and aid their nation in eradicating the Eldians on Paradis. However, just as all seems well for the two cadets, their peace is suddenly shaken by the arrival of Eren Yeager and the remaining members of the Survey Corps. Having finally reached the Yeager family basement and learned about the dark history surrounding the titans, the Survey Corps has at long last found the answer they so desperately fought to uncover. With the truth now in their hands, the group set out for the world beyond the walls. In Shingeki no Kyojin: The Final Season, two utterly different worlds collide as each party pursues its own agenda in the long-awaited conclusion to Paradis' fight for freedom. [Written by MAL Rewrite]
            </div>

            <a href="#" class="flex justify-between items-center rounded-xl bg-gray-200 dark:bg-gray-900 lg:w-96 h-16 mt-4 transition-colors duration-200 hover:bg-gray-300 dark:hover:bg-gray-700">
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

            <div class="flex flex-col mt-4">
                <h3 class="text-2xl font-semibold border-b border-dashed border-gray-400 border-opacity-50 pb-4">Tonton Di</h3>
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
        </div>
    </div>
</x-app-layout>