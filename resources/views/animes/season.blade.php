<x-app-layout>
    <x-slot name="title">Anime {{ $season_name . ' ' . $season_year }}</x-slot>
    
    <div class="container mx-auto px-4 pt-12">
        <h2 class="uppercase tracking-wider text-blue-700 text-lg font-semibold">Anime {{ $season_name . ' ' . $season_year }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach ($animes as $anime)
                <x-anime-card :anime="$anime" />
            @endforeach
        </div>
    </div>
</x-app-layout>