<x-app-layout>
    <x-slot name="title">{{ __('anime.genre.title') }} / {{ $genre->name }}{{ ($page > 1) ? ' (Hal. ' . $page . ')' : '' }}</x-slot>
    <x-slot name="meta_title">{{ __('anime.genre.title') }} / {{ $genre->name }}</x-slot>

    <div class="flex flex-col items-center justify-between gap-8 pb-4 md:flex-row">
        <div class="flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
            <x-title>{{ __('anime.genre.title') }} / {{ $genre->name }}</x-title>
        </div>
        @if ($total_page > 1) <x-pagination-link :current="$page" :total="$total_page" /> @endif
    </div>
    <x-anime-list>
        @foreach ($animes as $anime)
            <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
        @endforeach
    </x-anime-list>
    @if ($total_page > 1)
    <div class="flex flex-col items-center justify-between gap-2 mt-4 md:flex-row">
        <div class="font-primary">Halaman {{ $page }} / {{ $total_page }}</div>
        <x-pagination-link :current="$page" :total="$total_page" />
    </div>
    @endif
</x-app-layout>