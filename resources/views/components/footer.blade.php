<footer class="mt-auto bg-emerald-800 border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-col-reverse items-center justify-between gap-2 px-4 py-6 mx-auto md:px-6 xl:px-20 text-emerald-50 lg:flex-row lg:items-start" data-nosnippet>
        <div class="flex flex-row items-center gap-4">
            <div class="flex flex-row items-center gap-2">
                <img src="{{ logo_asset('img/logos/qctfw.png') }}" alt="Logo" class="h-6" />
                <span class="select-none">&bull;</span>
                {{ now()->year }}
            </div>
            <div class="flex-row items-center gap-4 flex dark:text-white">
                <a href="{{ config('anime.link.github') }}" target="_blank">
                    <i class="fa-brands fa-github text-2xl transition-colors duration-150 hover:text-emerald-300 dark:hover:text-gray-300"></i>
                </a>
                {{--
                <a href="{{ config('anime.link.twitter') }}" target="_blank">
                    <i class="fa-brands fa-twitter text-2xl transition-colors duration-150 hover:text-emerald-300 dark:hover:text-gray-300"></i>
                </a>
                --}}
                <a href="{{ config('anime.link.discord') }}" target="_blank">
                    <i class="fa-brands fa-discord text-xl transition-colors duration-150 hover:text-emerald-300 dark:hover:text-gray-300"></i>
                </a>
            </div>
        </div>
        <div class="flex flex-row items-center">
            <p>This website is not affiliated with <a href="https://myanimelist.net" rel="nofollow noopener noreferrer" target="_blank" class="text-emerald-300 hover:text-emerald-200 font-bold text-link-underline">MyAnimeList.</a></p>
        </div>
        <x-footer-menu />
    </div>
</footer>
