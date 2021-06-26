<x-app-layout>
    <x-slot name="title">Anime {{ $season_name . ' ' . $season_year }}</x-slot>
    
    <div class="container px-4 pt-12 mx-auto">
        <div class="flex flex-row items-center justify-center gap-8 pb-4">
            <a href="{{ route('anime.season', ['year' => $previous_season['year'], 'season' => $previous_season['season']]) }}" class="flex transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <a href="{{ route('anime.season', ['year' => $previous_season['year'], 'season' => $previous_season['season']]) }}" class="flex flex-col items-center transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <p class="text-lg">{{ ucfirst($previous_season['season']) }}</p>
                <p class="text-sm">{{ $previous_season['year'] }}</p>
            </a>
            <div class="flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
                <p class="text-3xl">{{ $season_name }}</p>
                <p class="text-md">{{ $season_year }}</p>
            </div>
            <a href="{{ route('anime.season', ['year' => $next_season['year'], 'season' => $next_season['season']]) }}" class="flex flex-col items-center transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <p class="text-lg">{{ ucfirst($next_season['season']) }}</p>
                <p class="text-sm">{{ $next_season['year'] }}</p>
            </a>
            <a href="{{ route('anime.season', ['year' => $next_season['year'], 'season' => $next_season['season']]) }}" class="flex transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
        <div class="grid items-start grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($animes as $anime)
                <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
            @endforeach
        </div>
    </div>
</x-app-layout>