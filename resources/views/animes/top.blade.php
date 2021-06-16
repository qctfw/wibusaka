<x-app-layout>
    <x-slot name="title">Anime {{ $type }}</x-slot>
    
    <div class="container mx-auto px-4 lg:px-32 pt-12">
        <h2 class="uppercase tracking-wider text-blue-300 text-lg font-semibold">Anime {{ $type }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-1 items-start mt-4 gap-4">
            @foreach ($top_animes as $anime)
            <x-anime-card-list :anime="$anime" />
            @endforeach
        </div>
    </div>
</x-app-layout>