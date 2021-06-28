<header x-data="{ mobileMenuOpen: false, topMenuOpen: false }" class="relative w-full p-4 bg-white border-b border-gray-300 dark:border-gray-700 dark:bg-gray-800 md:space-x-4" @click.away="mobileMenuOpen = false">
    <div class="container flex flex-row flex-wrap items-center justify-between mx-auto">
        <a href="{{ route('index') }}" class="block font-bold">
            <span class="sr-only">Logo</span>
            <img src="https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo1.png" alt="Logo" class="h-10" />
        </a>
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-block w-8 h-8 p-1 text-gray-600 bg-gray-200 dark:text-white dark:bg-gray-800 md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <nav class="absolute left-0 z-20 flex-col flex-auto w-full select-none font-semibold bg-gray-100 rounded-lg shadow-md md:ml-4 dark:bg-gray-800 md:relative top-16 md:top-0 md:flex md:flex-row md:space-x-2 md:w-auto md:bg-transparent md:shadow-none" :class="{ 'flex' : mobileMenuOpen , 'hidden' : !mobileMenuOpen}">
            <div @click="topMenuOpen = !topMenuOpen" @click.away="topMenuOpen = false" class="relative text-gray-600 rounded-lg cursor-pointer dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-900">
                <div class="flex flex-row items-center justify-between p-3 rounded-lg gap-4 dark:bg-gray-800 hover:text-blue-700 dark:hover:text-blue-300 dark:hover:bg-gray-900 dark:text-white" :class="{'bg-gray-300 text-blue-700 dark:text-blue-300 dark:bg-gray-900': topMenuOpen}">
                    <p>Top Anime</p>
                    {{-- heroicons/chevron-down --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transform" :class="{'rotate-0': !topMenuOpen, 'rotate-180': topMenuOpen}" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div x-show="topMenuOpen" class="relative left-0 w-full bg-gray-300 border-gray-400 dark:border-gray-600 rounded-lg shadow-xl md:border md:origin-top-left md:absolute md:w-56 dark:bg-gray-800 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div role="none">
                        <a href="{{ route('top.rated') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-900" role="menuitem" tabindex="-1" >
                            Anime Terbaik
                        </a>
                        <a href="{{ route('top.popular') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-900" role="menuitem" tabindex="-1" >
                            Anime Terpopuler
                        </a>
                        <a href="{{ route('top.upcoming') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-900" role="menuitem" tabindex="-1" >
                            Anime Paling Dinantikan
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ route('anime.season-current') }}" class="p-3 text-gray-600 rounded-lg dark:text-white hover:text-blue-700 dark:hover:text-blue-300 hover:bg-gray-300 dark:hover:bg-gray-900">
                Musim
            </a>
        </nav>
        <div class="flex flex-col items-center w-full md:w-64 lg:w-72 md:flex-row">
            <livewire:search-navbar />
        </div>
    </div>
</header>