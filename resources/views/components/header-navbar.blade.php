<header x-data="{ mobileMenuOpen: false, topMenuOpen: false }" class="relative w-full p-4 font-bold bg-emerald-800 border-b border-gray-300 dark:border-gray-700 dark:bg-gray-800 md:space-x-4 mx-auto md:px-6 xl:px-8 2xl:px-20" @click.away="mobileMenuOpen = false">
    <div class="flex flex-row flex-wrap gap-y-2 items-center justify-between" data-nosnippet>
        <a href="{{ route('anime.index') }}" class="block font-bold">
            <span class="sr-only">Logo</span>
            <img src="{{ randomize_logo() }}" alt="Logo" class="h-8" />
        </a>
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-block w-8 h-8 p-1 bg-emerald-900 text-emerald-50 dark:text-emerald-300 dark:bg-gray-900 md:hidden">
            <x-icons.menu class="w-6 h-6" />
        </button>
        <nav class="absolute left-0 z-20 flex-col justify-end flex-auto w-full font-semibold bg-emerald-900 rounded-lg shadow-md select-none font-primary lg:justify-start md:ml-4 dark:bg-gray-800 md:relative top-14 md:top-0 md:flex md:flex-row md:space-x-2 md:w-auto md:bg-transparent md:shadow-none" :class="{ 'flex' : mobileMenuOpen , 'hidden' : !mobileMenuOpen}">
            <div @click="topMenuOpen = !topMenuOpen" @click.away="topMenuOpen = false" class="relative rounded-lg cursor-pointer text-emerald-50">
                <div class="flex flex-row items-center justify-between gap-4 p-3 transition-colors duration-200 rounded-lg hover:text-emerald-900 dark:hover:text-white hover:bg-emerald-300 dark:hover:bg-emerald-800 dark:text-emerald-300" :class="{'bg-emerald-300 text-emerald-900 dark:text-white dark:bg-emerald-800': topMenuOpen}">
                    <p>Top Anime</p>
                    <x-icons.chevron-down-solid  class="w-5 h-5" x-bind:class="{'rotate-0': !topMenuOpen, 'rotate-180': topMenuOpen}" />
                </div>
                <div x-show="topMenuOpen" class="relative left-0 w-full bg-emerald-900 rounded-lg shadow-xl md:origin-top-left md:absolute md:w-56 dark:bg-gray-800 border border-emerald-200 border-opacity-30" x-cloak role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
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
        <div class="flex flex-row items-center w-full gap-3 lg:w-72">
            <livewire:search-navbar />
            <x-dropdown>
                <x-slot name="menu">
                    <button class="inline-block w-8 h-8 p-1 rounded-md transition duration-100 text-emerald-50 hover:text-emerald-800 hover:bg-emerald-300 group-focus-within:text-emerald-800 group-focus-within:bg-emerald-300 dark:hover:text-white dark:text-emerald-300 dark:hover:bg-emerald-800 dark:group-focus-within:bg-emerald-800 dark:group-focus-within:text-white">
                        <x-icons.sun class="w-6 h-6" />
                    </button>
                </x-slot>
                <div class="absolute -right-8 top-0 flex flex-col w-40 rounded-md text-sm bg-emerald-900 border border-emerald-200 border-opacity-30 text-emerald-50 dark:text-emerald-300 dark:bg-gray-800 shadow-lg outline-none" role="menu">
                    <button class="px-4 py-2 text-left transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800 rounded-t-md" data-setting="theme" data-option="default">Default <span>&#10003;</span></button>
                    <button class="px-4 py-2 text-left transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800" data-setting="theme" data-option="light">Light <span>&#10003;</span></button>
                    <button class="px-4 py-2 text-left transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800 rounded-b-md" data-setting="theme" data-option="dark">Dark <span>&#10003;</span></button>
                </div>
            </x-dropdown>
        </div>
    </div>
</header>
