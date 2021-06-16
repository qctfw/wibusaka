<nav x-data="{topOpen: false}" class="border-b border-gray-200 dark:border-gray-700">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
        <ul class="flex flex-col md:flex-row items-center">
            <li class="mt-0">
                <a href="/" class="font-bold text-xl">Logo</a>
            </li>
            <li @mouseover="topOpen = true" @mouseover.away="topOpen = false" class="relative md:ml-6 mt-0 p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-900 hover:text-blue-700 dark:hover:text-blue-300">
                <p class="font-medium ">Top Anime</p>
                <div x-show="topOpen" class="origin-top-left absolute left-0 mt-2 w-56 rounded-lg shadow-lg bg-gray-200 dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <a href="{{ route('top.rated') }}" class="hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" >
                            Anime Terbaik
                        </a>
                        <a href="{{ route('top.popular') }}" class="hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" >
                            Anime Terpopuler
                        </a>
                        <a href="{{ route('top.upcoming') }}" class="hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" >
                            Anime Paling Dinantikan
                        </a>
                    </div>
                </div>
            </li>
            <li class="md:ml-6 mt-0 p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-900">
                <a href="{{ route('anime.season-current') }}" class="font-medium hover:text-blue-700 dark:hover:text-blue-300">Anime Musim Ini</a>
            </li>
            <li class="md:ml-6 mt-0 p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-900">
                <a href="#" class="font-medium hover:text-blue-700 dark:hover:text-blue-300">Anime Musim Depan</a>
            </li>
        </ul>
        <div class="flex flex-col md:flex-row items-center">
            <div class="relative mt-3 md:mt-0">
                <input type="text" class="bg-gray-300 dark:bg-gray-900 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:ring focus:border-blue-300" placeholder="Cari...">
                <div class="absolute top-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-gray-500 dark:text-white mt-1.5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</nav>