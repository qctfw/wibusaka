<header x-data="{ mobileMenuOpen: false, topMenuOpen: false }" class="fixed top-0 flex flex-col bg-green-800 dark:bg-transparent items-center justify-center w-full p-4 font-bold md:space-x-4 md:h-20" @click.away="mobileMenuOpen = false">
    <div class="container flex flex-row flex-wrap items-center justify-between mx-auto md:justify-center" data-nosnippet>
        <a href="{{ route('index') }}" class="block font-bold">
            <span class="sr-only">Logo</span>
            <img src="{{ randomize_logo() }}" alt="Logo" class="h-8" />
        </a>
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="inline-block w-8 h-8 p-1 bg-green-900 text-green-50 dark:text-green-300 dark:bg-gray-900 md:hidden">
            <x-icons.menu class="w-6 h-6" />
        </button>
        <nav class="absolute left-0 z-20 flex-col justify-end flex-auto w-full font-semibold bg-green-900 rounded-lg shadow-md select-none font-primary lg:justify-start md:ml-4 dark:bg-gray-800 md:relative top-16 md:top-0 md:flex md:flex-row md:space-x-2 md:w-auto md:bg-transparent md:shadow-none" :class="{ 'flex' : mobileMenuOpen , 'hidden' : !mobileMenuOpen}">
            {{--  --}}
        </nav>
        <div class="flex flex-col items-center w-full mt-2 md:w-64 lg:w-72 md:flex-row lg:mt-0">
            <livewire:search-navbar />
        </div>
    </div>
</header>