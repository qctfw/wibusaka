<header x-data="{ mobileMenuOpen: false, topMenuOpen: false }" class="relative w-full p-4 bg-white border-b border-gray-300 dark:border-gray-700 dark:bg-gray-800 md:space-x-4" @click.away="mobileMenuOpen = false">
    <div class="container flex flex-row flex-wrap items-center justify-between mx-auto md:justify-center">
        <a href="{{ route('index') }}" class="block font-bold">
            <span class="sr-only">Logo</span>
            <img src="https://placeholder.com/wp-content/uploads/2018/10/placeholder.com-logo1.png" alt="Logo" class="h-10" />
        </a>
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-block w-8 h-8 p-1 text-gray-600 bg-gray-200 dark:text-white dark:bg-gray-800 md:hidden">
            <x-icons.menu class="w-6 h-6" />
        </button>
        <nav class="justify-end lg:justify-start absolute left-0 z-20 flex-col flex-auto w-full font-semibold bg-gray-100 rounded-lg shadow-md select-none md:ml-4 dark:bg-gray-800 md:relative top-16 md:top-0 md:flex md:flex-row md:space-x-2 md:w-auto md:bg-transparent md:shadow-none" :class="{ 'flex' : mobileMenuOpen , 'hidden' : !mobileMenuOpen}">
            <div @click="topMenuOpen = !topMenuOpen" @click.away="topMenuOpen = false" class="relative text-gray-600 rounded-lg cursor-pointer dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-900">
                <div class="flex flex-row items-center justify-between gap-4 p-3 rounded-lg dark:bg-gray-800 hover:text-blue-700 dark:hover:text-blue-300 dark:hover:bg-gray-900 dark:text-white" :class="{'bg-gray-300 text-blue-700 dark:text-blue-300 dark:bg-gray-900': topMenuOpen}">
                    <p>Top Anime</p>
                    <x-icons.chevron-down-solid  class="w-5 h-5 transform" x-bind:class="{'rotate-0': !topMenuOpen, 'rotate-180': topMenuOpen}" />
                </div>
                <div x-show="topMenuOpen" class="relative left-0 w-full bg-gray-300 border-gray-400 rounded-lg shadow-xl dark:border-gray-600 md:border md:origin-top-left md:absolute md:w-56 dark:bg-gray-800 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div role="none">
                        <a href="{{ route('anime.top.rated') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-900" role="menuitem" tabindex="-1" >
                            {{ __('anime.top.title.rated') }}
                        </a>
                        <a href="{{ route('anime.top.popular') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-900" role="menuitem" tabindex="-1" >
                            {{ __('anime.top.title.popularity') }}
                        </a>
                        <a href="{{ route('anime.top.airing') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-900" role="menuitem" tabindex="-1" >
                            {{ __('anime.top.title.airing') }}
                        </a>
                        <a href="{{ route('anime.top.upcoming') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-blue-700 dark:hover:text-blue-300 dark:text-white hover:bg-gray-400 dark:hover:bg-gray-900" role="menuitem" tabindex="-1" >
                            {{ __('anime.top.title.upcoming') }}
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ route('anime.season-current') }}" class="p-3 text-gray-600 rounded-lg dark:text-white hover:text-blue-700 dark:hover:text-blue-300 hover:bg-gray-300 dark:hover:bg-gray-900">
                {{ __('anime.season.title') }}
            </a>
            <a href="{{ route('anime.genre') }}" class="p-3 text-gray-600 rounded-lg dark:text-white hover:text-blue-700 dark:hover:text-blue-300 hover:bg-gray-300 dark:hover:bg-gray-900">
                {{ __('anime.genre.title') }}
            </a>
        </nav>
        <div class="flex flex-col items-center w-full md:w-64 lg:w-72 md:flex-row mt-2 lg:mt-0">
            <livewire:search-navbar />
        </div>
    </div>
</header>