<x-app-layout>
    <x-slot name="title">Top Anime</x-slot>

    <div class="container px-4 pt-12 mx-auto">
        <a href="{{ route('anime.top.popular') }}">
            <x-title>Top Anime</x-title>
        </a>
        <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-6">
            @foreach ($top_animes as $anime)
            <x-anime-card-cover :anime="$anime" :resources="$top_resources[$anime['mal_id']]" />
            @endforeach
        </div>
        <a href="{{ route('anime.top.upcoming') }}">
            <x-title>Anime Paling Dinantikan</x-title>
        </a>
        <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-6">
            @foreach ($upcoming_animes as $anime)
            <x-anime-card-cover :anime="$anime" />
            @endforeach
        </div>
    </div>
</x-app-layout>