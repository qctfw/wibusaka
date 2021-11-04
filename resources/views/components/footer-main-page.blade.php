<footer x-data="{open: false, menu: ''}" class="fixed bottom-0 w-full p-4">
    <x-footer-menu />
    <div class="flex flex-row items-center justify-center gap-4 mt-2">
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
</footer>