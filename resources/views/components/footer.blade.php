<footer class="mt-4 bg-green-800 border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-col items-center justify-between gap-1 px-4 py-6 mx-auto md:px-6 xl:px-20 text-green-50 md:flex-row md:items-start" data-nosnippet>
        <div class="flex flex-row items-center gap-4">
            <div class="flex flex-row items-center gap-2">
                <img src="{{ randomize_logo() }}" alt="Logo" class="h-6" />
                <span class="select-none">&bull;</span>
                2021
            </div>
            <div class="flex-row items-center hidden gap-4 md:flex dark:text-white">
                <a href="{{ config('anime.link.github') }}" target="_blank">
                    <x-icons.github class="w-6 h-6 transition-colors duration-150 hover:text-green-300 dark:hover:text-gray-300" fill="currentColor" />
                </a>
                {{--
                <a href="{{ config('anime.link.twitter') }}" target="_blank">
                    <x-icons.twitter class="w-6 h-6 transition-colors duration-150 hover:text-green-300 dark:hover:text-gray-300" fill="currentColor" />
                </a>
                --}}
                <a href="{{ config('anime.link.discord') }}" target="_blank">
                    <x-icons.discord class="w-6 h-6 transition-colors duration-150 hover:text-green-300 dark:hover:text-gray-300" fill="currentColor" />
                </a>
            </div>
        </div>
        <x-footer-menu />
        <div class="flex flex-col gap-2 text-center md:flex-row md:text-right">
            <p>Powered by <a href="https://jikan.moe" class="font-semibold hover:underline">Jikan.moe</a> API</p>
        </div>
        <div class="flex flex-row items-center gap-4 md:hidden dark:text-white">
            <a href="{{ config('anime.link.github') }}" target="_blank">
                <x-icons.github class="w-6 h-6" fill="currentColor" />
            </a>
            {{--
            <a href="{{ config('anime.link.twitter') }}" target="_blank">
                <x-icons.twitter class="w-6 h-6" fill="currentColor" />
            </a>
            --}}
            <a href="{{ config('anime.link.discord') }}" target="_blank">
                <x-icons.discord class="w-6 h-6" fill="currentColor" />
            </a>
        </div>
    </div>
</footer>