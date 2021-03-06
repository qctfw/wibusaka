<header x-data="{ mobileMenuOpen: false, topMenuOpen: false }" class="relative w-full p-4 font-bold bg-emerald-800 border-b border-gray-300 dark:border-gray-700 dark:bg-gray-800 md:space-x-4 mx-auto md:px-6 xl:px-8 2xl:px-20" @click.away="mobileMenuOpen = false">
    <div class="flex flex-row flex-wrap items-center justify-between" data-nosnippet>
        <a href="{{ route('anime.index') }}" class="block font-bold">
            <span class="sr-only">Logo</span>
            <img src="{{ randomize_logo() }}" alt="Logo" class="h-8" />
        </a>
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-block w-8 h-8 p-1 bg-emerald-900 text-emerald-50 dark:text-emerald-300 dark:bg-gray-900 md:hidden">
            <x-icons.menu class="w-6 h-6" />
        </button>
        <nav class="absolute left-0 z-20 flex-col justify-end flex-auto w-full font-semibold bg-emerald-900 rounded-lg shadow-md select-none font-primary lg:justify-start md:ml-4 dark:bg-gray-800 md:relative top-16 md:top-0 md:flex md:flex-row md:space-x-2 md:w-auto md:bg-transparent md:shadow-none" :class="{ 'flex' : mobileMenuOpen , 'hidden' : !mobileMenuOpen}">
            <div @click="topMenuOpen = !topMenuOpen" @click.away="topMenuOpen = false" class="relative rounded-lg cursor-pointer text-emerald-50">
                <div class="flex flex-row items-center justify-between gap-4 p-3 transition-colors duration-200 rounded-lg hover:text-emerald-900 dark:hover:text-white hover:bg-emerald-300 dark:hover:bg-emerald-800 dark:text-emerald-300" :class="{'bg-emerald-300 text-emerald-900 dark:text-white dark:bg-emerald-800': topMenuOpen}">
                    <p>Top Anime</p>
                    <x-icons.chevron-down-solid  class="w-5 h-5" x-bind:class="{'rotate-0': !topMenuOpen, 'rotate-180': topMenuOpen}" />
                </div>
                <div x-show="topMenuOpen" class="relative left-0 w-full bg-emerald-900 rounded-lg shadow-xl md:origin-top-left md:absolute md:w-56 dark:bg-gray-800 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div role="none">
                        <a href="{{ route('anime.top.rated') }}" class="block px-4 py-2 text-sm transition-colors duration-200 rounded-lg hover:text-emerald-900 dark:hover:text-white dark:text-emerald-300 hover:bg-emerald-300 dark:hover:bg-emerald-800" role="menuitem" tabindex="-1" >
                            {{ __('anime.top.title.rated') }}
                        </a>
                        <a href="{{ route('anime.top.popular') }}" class="block px-4 py-2 text-sm transition-colors duration-200 rounded-lg hover:text-emerald-900 dark:hover:text-white dark:text-emerald-300 hover:bg-emerald-300 dark:hover:bg-emerald-800" role="menuitem" tabindex="-1" >
                            {{ __('anime.top.title.popularity') }}
                        </a>
                        <a href="{{ route('anime.top.airing') }}" class="block px-4 py-2 text-sm transition-colors duration-200 rounded-lg hover:text-emerald-900 dark:hover:text-white dark:text-emerald-300 hover:bg-emerald-300 dark:hover:bg-emerald-800" role="menuitem" tabindex="-1" >
                            {{ __('anime.top.title.airing') }}
                        </a>
                        <a href="{{ route('anime.top.upcoming') }}" class="block px-4 py-2 text-sm transition-colors duration-200 rounded-lg hover:text-emerald-900 dark:hover:text-white dark:text-emerald-300 hover:bg-emerald-300 dark:hover:bg-emerald-800" role="menuitem" tabindex="-1" >
                            {{ __('anime.top.title.upcoming') }}
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ route('anime.season-current') }}" class="p-3 transition-colors duration-200 rounded-lg text-emerald-50 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-white hover:bg-emerald-300 dark:hover:bg-emerald-800">
                {{ __('anime.season.title') }}
            </a>
            <a href="{{ route('anime.schedule') }}" class="p-3 transition-colors duration-200 rounded-lg text-emerald-50 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-white hover:bg-emerald-300 dark:hover:bg-emerald-800">
                {{ __('anime.schedule.title') }}
            </a>
            <a href="{{ route('anime.genre.index') }}" class="p-3 transition-colors duration-200 rounded-lg text-emerald-50 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-white hover:bg-emerald-300 dark:hover:bg-emerald-800">
                {{ __('anime.genre.title') }}
            </a>
        </nav>
        <div class="flex flex-col items-center w-full mt-2 md:w-64 lg:w-72 md:flex-row lg:mt-0">
            <livewire:search-navbar />
        </div>
    </div>
</header>