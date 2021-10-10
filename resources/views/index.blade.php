<x-app-layout>
    <x-slot name="title">{{ __('meta.default.title') }}</x-slot>

    <section class="flex items-center justify-center h-screen text-center">
        <div class="flex flex-col items-center w-full lg:w-2/3 gap-4">
            <h1 class="text-4xl lg:text-7xl font-bold font-primary">
                {!! $selected_quote !!}
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
    </section>
</x-app-layout>