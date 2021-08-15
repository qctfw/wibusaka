<x-app-layout>
    <x-slot name="title">Halaman Utama</x-slot>

    <div class="container flex flex-col gap-4 px-4 pt-12 mx-auto">
        <div class="flex flex-col">
            <x-title>
                <a href="{{ route('anime.top.popular') }}">{{ __('anime.top.title.rated') }}</a>
            </x-title>
            <x-library-scroll>
                @foreach ($top_animes as $anime)
                <x-anime-card-cover :anime="$anime" :resources="$top_resources[$anime['mal_id']]" class="flex-shrink-0 w-52 snap-center" />
                @endforeach
            </x-library-scroll>
        </div>
        <div class="mt-2 flex flex-col">
            <x-title>
                <a href="{{ route('anime.top.upcoming') }}">{{ __('anime.top.title.upcoming') }}</a>
            </x-title>
            <x-library-scroll>
                @foreach ($upcoming_animes as $anime)
                <x-anime-card-cover :anime="$anime" class="flex-shrink-0 w-52 snap-center" />
                @endforeach
            </x-library-scroll>
        </div>
    </div>
</x-app-layout>