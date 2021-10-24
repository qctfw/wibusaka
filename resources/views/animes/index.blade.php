<x-app-layout>
    <x-slot name="title">Halaman Utama</x-slot>
    <x-slot name="meta_title">{{ __('meta.default.title') }}</x-slot>

    <div class="flex flex-col gap-6 px-4 md:px-6 xl:px-20 pt-12 mx-auto">
        @foreach ($sections as $section)
        <div class="flex flex-col gap-2">
            <x-title>
                <a href="{{ $section['route'] }}">{{ $section['title'] }} <x-icons.chevron-right-solid class="w-6 h-6 inline-block" /></a>
            </x-title>
            <x-library-scroll>
                @foreach ($section['animes'] as $anime)
                <x-anime-card-cover :anime="$anime" :resources="$resources[$anime['mal_id']] ?? null" class="flex-shrink-0 w-44 md:w-48 xl:w-52 snap-center" />
                @endforeach
            </x-library-scroll>
        </div>
        @endforeach

        <div class="grid justify-center grid-cols-1 gap-4 md:grid-cols-3">
            <x-button-link href="{{ route('anime.top.popular') }}">
                <x-slot name="icon">
                    <x-icons.chevron-right-solid class="w-6 h-6" />
                </x-slot>

                <p class="text-lg font-semibold font-primary md:text-xl">{{ __('anime.top.title.popularity') }}</p>
            </x-button-link>
            <x-button-link href="{{ route('anime.top.rated') }}">
                <x-slot name="icon">
                    <x-icons.chevron-right-solid class="w-6 h-6" />
                </x-slot>

                <p class="text-lg font-semibold font-primary md:text-xl">{{ __('anime.top.title.rated') }}</p>
            </x-button-link>
            <x-button-link href="{{ route('anime.genre') }}">
                <x-slot name="icon">
                    <x-icons.chevron-right-solid class="w-6 h-6" />
                </x-slot>

                <p class="text-lg font-semibold font-primary md:text-xl">{{ __('anime.genre.title') }}</p>
            </x-button-link>
        </div>
    </div>
</x-app-layout>