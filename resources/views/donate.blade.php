<x-app-layout>
    <x-slot name="title">{{ __('meta.default.title') }}</x-slot>

    <section x-data="{}" class="flex items-center justify-center min-h-screen text-center -mt-12">
        <div class="flex flex-col items-center w-full gap-4 px-4 lg:w-2/3 md:px-6">
            <h1 class="text-emerald-500 font-bold text-4xl md:text-6xl font-primary" data-nosnippet>
                {{ __('anime.donation.title') }} <i class="fa-regular fa-face-laugh-beam"></i>
            </h1>
            <p class="text-lg lg:text-xl">{{ __('anime.donation.subtitle') }}</p>
            <div class="flex flex-col md:flex-row justify-center items-center gap-3 w-full mt-4">
                <x-button-link class="w-full" href="{{ config('anime.link.trakteer') }}" target="_blank">
                    <x-slot name="customImg">
                        <div class="flex flex-none w-16 h-16 mx-auto">
                            <img src="https://cdn.trakteer.id/images/embed/trbtn-icon.png" alt="Icon" class="mx-auto" />
                        </div>
                    </x-slot>
                    <div class="flex flex-row items-center gap-2 pl-2 text-lg font-semibold font-primary">
                        <p>Trakteer</p>
                    </div>
                </x-button-link>
                <x-button-link class="w-full" href="{{ config('anime.link.github') }}" target="_blank">
                    <x-slot name="customImg">
                        <div class="flex flex-none w-16 h-16 mx-auto items-center justify-center">
                            <i class="fa-brands fa-github text-5xl"></i>
                        </div>
                    </x-slot>
                    <div class="flex flex-row items-center gap-2 pl-2 text-lg font-semibold font-primary">
                        <p>GitHub Sponsors</p>
                    </div>
                </x-button-link>
            </div>
        </div>
    </section>
</x-app-layout>
