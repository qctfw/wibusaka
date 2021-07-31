<x-app-layout>
    <x-slot name="title">Halaman Utama</x-slot>

    <div class="container flex flex-col gap-4 px-4 pt-12 mx-auto">
        <div class="flex flex-col gap-2">
            <x-title>
                <a href="{{ route('anime.top.popular') }}">{{ __('anime.top.title.rated') }}</a>
            </x-title>
            <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-6">
                @foreach ($top_animes as $anime)
                <x-anime-card-cover :anime="$anime" :resources="$top_resources[$anime['mal_id']]" />
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <x-title>
                <a href="{{ route('anime.top.upcoming') }}">{{ __('anime.top.title.upcoming') }}</a>
            </x-title>
            <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-6">
                @foreach ($upcoming_animes as $anime)
                <x-anime-card-cover :anime="$anime" />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>