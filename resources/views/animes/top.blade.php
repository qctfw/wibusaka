<x-app-layout>
    <x-slot name="title">Anime {{ $type }}{{ ($page > 1) ? ' (Hal. ' . $page . ')' : '' }}</x-slot>
    
    <div class="container px-4 pt-12 mx-auto lg:px-32">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <h2 class="text-xl font-semibold tracking-wider text-blue-700 uppercase dark:text-blue-300">Anime {{ $type }}</h2>
            <x-pagination-link :current="$page" :total="$total_page" />
        </div>
        <div class="grid items-start grid-cols-2 gap-4 mt-4 md:grid-cols-1">
            @foreach ($top_animes as $anime)
            <x-anime-card-list :anime="$anime" :resources="$resources[$anime['mal_id']]" />
            @endforeach
        </div>
        <div class="flex flex-row items-center justify-center mt-4">
            <x-pagination-link :current="$page" :total="$total_page" />
        </div>
    </div>
</x-app-layout>