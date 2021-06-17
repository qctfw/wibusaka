<x-app-layout>
    <x-slot name="title">Anime {{ $type }}</x-slot>
    
    <div class="container px-4 pt-12 mx-auto lg:px-32">
        <h2 class="text-lg font-semibold tracking-wider text-blue-700 uppercase dark:text-blue-300">Anime {{ $type }}</h2>
        <div class="grid items-start grid-cols-2 gap-4 mt-4 md:grid-cols-1">
            @foreach ($top_animes as $anime)
            <x-anime-card-list :anime="$anime" />
            @endforeach
        </div>
    </div>
</x-app-layout>