<x-app-layout>
    <x-slot name="title">Top Anime</x-slot>

    <div class="container px-4 pt-12 mx-auto">
        <a href="{{ route('top.popular') }}" class="text-lg font-semibold tracking-wider text-blue-700 uppercase dark:text-blue-300">Top Anime</a>
        <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-6">
            @foreach ($top_animes as $anime)
            <x-anime-card-cover :anime="$anime" :resources="$top_resources[$anime['mal_id']]" />
            @endforeach
        </div>
        <a href="{{ route('top.upcoming') }}" class="pt-12 text-lg font-semibold tracking-wider text-blue-700 uppercase dark:text-blue-300">Anime Paling Dinantikan</a>
        <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-6">
            @foreach ($upcoming_animes as $anime)
            <x-anime-card-cover :anime="$anime" />
            @endforeach
        </div>
    </div>
</x-app-layout>