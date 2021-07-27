<footer class="mt-4 border-t border-gray-200 footer dark:border-gray-700">
    <div class="container flex flex-col items-center justify-between gap-1 px-4 py-6 mx-auto md:flex-row">
        <div class="flex flex-row items-center gap-4">
            <p>WibuList <span class="select-none">&bull;</span> 2021</p>
            <div class="flex-row items-center hidden gap-4 text-gray-700 md:flex dark:text-white">
                <a href="{{ config('anime.link.github') }}" target="_blank">
                    <x-icons.github class="w-6 h-6 transition-colors duration-150 hover:text-gray-500 dark:hover:text-gray-300" fill="currentColor" />
                </a>
                <a href="{{ config('anime.link.twitter') }}" target="_blank">
                    <x-icons.twitter class="w-6 h-6 transition-colors duration-150 hover:text-gray-500 dark:hover:text-gray-300" fill="currentColor" />
                </a>
                <a href="{{ config('anime.link.discord') }}" target="_blank">
                    <x-icons.discord class="w-6 h-6 transition-colors duration-150 hover:text-gray-500 dark:hover:text-gray-300" fill="currentColor" />
                </a>
            </div>
        </div>
        <p>Powered by <a href="https://jikan.moe" class="font-semibold hover:underline">Jikan.moe</a> API</p>
        <div class="flex flex-row items-center gap-4 text-gray-700 md:hidden dark:text-white">
            <a href="{{ config('anime.link.github') }}" target="_blank">
                <x-icons.github class="w-6 h-6" fill="currentColor" />
            </a>
            <a href="{{ config('anime.link.twitter') }}" target="_blank">
                <x-icons.twitter class="w-6 h-6" fill="currentColor" />
            </a>
            <a href="{{ config('anime.link.discord') }}" target="_blank">
                <x-icons.discord class="w-6 h-6" fill="currentColor" />
            </a>
        </div>
    </div>
</footer>