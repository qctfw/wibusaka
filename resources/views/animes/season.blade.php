<x-app-layout>
    <x-slot name="title">Anime {{ $season_name . ' ' . $season_year }}</x-slot>
    
    <div class="container px-4 pt-12 mx-auto">
        <h2 class="text-lg font-semibold tracking-wider text-blue-700 uppercase dark:text-blue-300">Anime {{ $season_name . ' ' . $season_year }}</h2>
        <div class="grid grid-cols-1 items-start gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($animes as $anime)
                <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
            @endforeach
        </div>
    </div>
</x-app-layout>