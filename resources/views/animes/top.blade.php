<x-app-layout>
    <x-slot name="title">{{ $title }}{{ ($page > 1) ? ' (Hal. ' . $page . ')' : '' }}</x-slot>
    
    <div class="container px-4 pt-12 mx-auto lg:px-32">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <x-title :title="$title" />
            @if ($total_page > 1) <x-pagination-link :current="$page" :total="$total_page" /> @endif
        </div>
        <div class="grid items-start grid-cols-2 gap-4 mt-4 md:grid-cols-1">
            @foreach ($top_animes as $anime)
            <x-anime-card-list :anime="$anime" :resources="$resources[$anime['mal_id']]" />
            @endforeach
        </div>
        @if ($total_page > 1)
        <div class="flex flex-row items-center justify-center mt-4">
            <x-pagination-link :current="$page" :total="$total_page" />
        </div>
        @endif
    </div>
</x-app-layout>