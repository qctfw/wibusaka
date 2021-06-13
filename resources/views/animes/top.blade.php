<x-app-layout>
    <x-slot name="title">Top Anime</x-slot>

    <div class="container mx-auto px-4 pt-12">
        <h2 class="uppercase tracking-wider text-blue-300 text-lg font-semibold">Top Anime</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 items-end gap-8 py-4">
            @foreach ($top_animes as $anime)
            <x-anime-card-cover :anime="$anime" />
            @endforeach
        </div>
        <h2 class="uppercase tracking-wider text-blue-300 text-lg font-semibold pt-12">Anime Paling Dinantikan</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 items-end gap-8 py-4">
            @foreach ($upcoming_animes as $anime)
            <x-anime-card-cover :anime="$anime" />
            @endforeach
        </div>
    </div>
</x-app-layout>