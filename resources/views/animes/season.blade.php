<x-app-layout>
    <x-slot name="title">Anime {{ $seasons['current']['season'] . ' ' . $seasons['current']['year'] }}</x-slot>
    
    <div class="container px-4 pt-12 mx-auto">
        <div class="flex flex-row items-center justify-center gap-8 pb-4">

            @if (!is_null($seasons['previous']))
            <a href="{{ route('anime.season', ['year' => $seasons['previous']['year'], 'season' => $seasons['previous']['season']]) }}" class="flex transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <a href="{{ route('anime.season', ['year' => $seasons['previous']['year'], 'season' => $seasons['previous']['season']]) }}" class="flex flex-col items-center transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <p class="text-lg">{{ ucfirst($seasons['previous']['season']) }}</p>
                <p class="text-sm">{{ $seasons['previous']['year'] }}</p>
            </a>
            @endif

            <div class="flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
                <p class="text-3xl">{{ $seasons['current']['season'] }}</p>
                <p class="text-md">{{ $seasons['current']['year'] }}</p>
            </div>

            @if (!is_null($seasons['next']))
            <a href="{{ route('anime.season', ['year' => $seasons['next']['year'], 'season' => $seasons['next']['season']]) }}" class="flex flex-col items-center transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <p class="text-lg">{{ ucfirst($seasons['next']['season']) }}</p>
                <p class="text-sm">{{ $seasons['next']['year'] }}</p>
            </a>
            <a href="{{ route('anime.season', ['year' => $seasons['next']['year'], 'season' => $seasons['next']['season']]) }}" class="flex transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
            @endif

        </div>
        <div class="grid items-start grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($animes as $anime)
                <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
            @endforeach
        </div>
    </div>
</x-app-layout>