<x-app-layout>
    <x-slot name="title">Top Anime</x-slot>

    <div class="container px-4 pt-12 mx-auto">
        <h2 class="text-lg font-semibold tracking-wider text-blue-700 uppercase dark:text-blue-300">Top Anime</h2>
        <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-5">
            @foreach ($top_animes as $anime)
            <x-anime-card-cover :anime="$anime" :resources="$top_resources[$anime['mal_id']]" />
            @endforeach
        </div>
        <h2 class="pt-12 text-lg font-semibold tracking-wider text-blue-700 uppercase dark:text-blue-300">Anime Paling Dinantikan</h2>
        <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-5">
            @foreach ($upcoming_animes as $anime)
            <x-anime-card-cover :anime="$anime" />
            @endforeach
        </div>
    </div>
</x-app-layout>