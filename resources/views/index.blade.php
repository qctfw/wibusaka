<x-app-layout>
    <x-slot name="title">{{ __('meta.default.title') }}</x-slot>

    <section x-data="{}" class="flex items-center justify-center h-screen text-center">
        <div class="flex flex-col items-center w-full lg:w-2/3 gap-4">
            <h1
                class="text-4xl lg:text-7xl font-bold cursor-pointer font-primary"
                x-ref="title"
                x-on:click="regenerateQuote"
                x-on:webkitAnimationEnd="$refs.title.classList.remove('animate-blink');"
                x-on:oanimationend="$refs.title.classList.remove('animate-blink');"
                x-on:msAnimationEnd="$refs.title.classList.remove('animate-blink');"
                x-on:animationend="$refs.title.classList.remove('animate-blink');"
                >
                {!! preg_replace('/\*{2}([^*]*)\*{2}/', '<span class="text-green-500">$1</span>', $selected_quote) !!}
            </h1>
            <p class="text-lg lg:text-xl">{{ __('anime.main.subtitle') }}</p>
            <div class="w-1/2 lg:w-1/4 mt-4">
                <x-button-link href="{{ route('anime.index') }}">
                    <x-slot name="icon">
                        <x-icons.chevron-right-solid class="w-6 h-6" />
                    </x-slot>

                    <p class="text-lg font-semibold font-primary md:text-xl">Buka</p>
                </x-button-link>
            </div>
        </div>
        <script>
            const allQuotes = {!! json_encode($quotes) !!};
            function regenerateQuote(e) {
                const el = document.querySelector('[x-ref=title]');
                el.classList.add('animate-blink');

                let gachaRNG = Math.floor((Math.random() * 100) + 1);
                let quotes = (gachaRNG <= 5 || {{ intval(env('TITLE_ABNORMAL_HACK', false)) }}) ? allQuotes.abnormal : allQuotes.normal;

                setTimeout(() => {
                    el.innerHTML = quotes[Math.floor(Math.random() * quotes.length)].replace(/\*{2}([^*]*)\*{2}/gim, '<span class="text-green-500">$1</span>');
                }, 500);
            }

        </script>
    </section>
</x-app-layout>