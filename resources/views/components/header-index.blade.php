<header x-data="{ mobileMenuOpen: false, topMenuOpen: false }" class="fixed top-0 flex flex-col items-center justify-center w-full p-4 font-bold bg-emerald-800 dark:bg-transparent md:space-x-4 md:h-20 mx-auto md:px-6 xl:px-8 2xl:px-20" @click.away="mobileMenuOpen = false">
    <div class="flex flex-row flex-wrap items-center justify-center w-full gap-y-2 md:justify-between" data-nosnippet>
        <a href="{{ route('index') }}" class="block font-bold">
            <span class="sr-only">Logo</span>
            <img src="{{ randomize_logo() }}" alt="Logo" class="h-8" />
        </a>
        <div class="flex flex-row items-center w-full gap-3 md:w-64 lg:w-72">
            <livewire:search-navbar />
            <x-dropdown>
                <x-slot name="menu">
                    <button class="inline-block w-8 h-8 p-1 rounded-md transition duration-100 text-emerald-50 hover:text-emerald-800 hover:bg-emerald-300 group-focus-within:text-emerald-800 group-focus-within:bg-emerald-300 dark:hover:text-white dark:text-emerald-300 dark:hover:bg-emerald-800 dark:group-focus-within:bg-emerald-800 dark:group-focus-within:text-white">
                        <i class="fa-solid fa-sun text-lg"></i>
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
