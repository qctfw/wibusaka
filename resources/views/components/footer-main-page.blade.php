<footer x-data="{open: false, menu: ''}" class="fixed bottom-0 w-full p-4">
    <x-footer-menu />
    <div class="flex flex-row items-center justify-center gap-4 mt-2">
        <a href="{{ config('anime.link.github') }}" target="_blank">
            <i class="fa-brands fa-github text-2xl"></i>
        </a>
        {{--
        <a href="{{ config('anime.link.twitter') }}" target="_blank">
            <i class="fa-brands fa-twitter text-2xl"></i>
        </a>
        --}}
        <a href="{{ config('anime.link.discord') }}" target="_blank">
            <i class="fa-brands fa-discord text-xl"></i>
        </a>
    </div>
</footer>
