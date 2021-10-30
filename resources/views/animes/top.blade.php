<x-app-layout>
    <x-slot name="title">{{ $title }}{{ ($page > 1) ? ' (Hal. ' . $page . ')' : '' }}</x-slot>
    <x-slot name="meta_description">{{ __('meta.top.description') }}</x-slot>

    <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
        <x-title :title="$title" />
        @if ($total_page > 1) <x-pagination-link :current="$page" :total="$total_page" /> @endif
    </div>
    <div class="grid items-start grid-cols-2 gap-4 mt-4 md:grid-cols-1">
        @foreach ($top_animes as $anime)
        <x-anime-card-list :anime="$anime" :resources="$resources[$anime['mal_id']]" />
        @endforeach
    </div>
    @if ($total_page > 1)
    <div class="flex flex-col items-center justify-between gap-2 mt-4 md:flex-row">
        <div class="font-primary">Halaman {{ $page }} / {{ $total_page }}</div>
        <x-pagination-link :current="$page" :total="$total_page" />
    </div>
    @endif
</x-app-layout>