<x-app-layout>
    <x-slot name="title">Main Page</x-slot>
    
    <div class="container mx-auto px-4 pt-12">
        <h2 class="uppercase tracking-wider text-blue-300 text-lg font-semibold">Anime {{ $result['season_name'] . ' ' . $result['season_year'] }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach ($result['animes'] as $anime)
                <x-anime-card :anime="$anime" />
            @endforeach
        </div>
    </div>
</x-app-layout>