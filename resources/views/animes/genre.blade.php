<x-app-layout>
    <x-slot name="title">Genre Anime - {{ $genre->name }}{{ ($page > 1) ? ' (Hal. ' . $page . ')' : '' }}</x-slot>
    
    <div class="container px-4 pt-12 mx-auto">
        <div class="flex flex-col items-center justify-between gap-8 pb-4 md:flex-row">
            <div class="flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
                <p class="text-2xl">Genre Anime / {{ $genre->name }}</p>
            </div>
            <x-pagination-link :current="$page" :total="$total_page" />
        </div>
        <div class="grid items-start justify-center grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($animes as $anime)
                <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
            @endforeach
        </div>
        <div class="flex flex-row items-center justify-center mt-4">
            <x-pagination-link :current="$page" :total="$total_page" />
        </div>
    </div>
</x-app-layout>