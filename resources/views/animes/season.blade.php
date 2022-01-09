<x-app-layout>
    <x-slot name="title">{{ __('anime.season.title') }} {{ ucfirst($seasons['current']['season']) . ' ' . $seasons['current']['year'] }}</x-slot>
    <x-slot name="meta_description">{{ __('meta.season.description', ['season' => $seasons['current']['season'] . ' ' . $seasons['current']['year']]) }}</x-slot>
    
    <div class="flex flex-row items-center justify-center gap-8 pb-4 font-primary">
        @if (!is_null($seasons['previous']))
        <a href="{{ route('anime.season', ['year' => $seasons['previous']['year'], 'season' => $seasons['previous']['season']]) }}" class="flex text-link">
            <x-icons.arrow-left class="w-6 h-6" />
        </a>
        <a href="{{ route('anime.season', ['year' => $seasons['previous']['year'], 'season' => $seasons['previous']['season']]) }}" class="flex flex-col items-center text-link">
            <p class="text-xl">{{ ucfirst($seasons['previous']['season']) }}</p>
            <p class="text-sm">{{ $seasons['previous']['year'] }}</p>
        </a>
        @endif

        <div class="flex flex-col items-center font-bold text-emerald-700 dark:text-emerald-300">
            <p class="text-3xl">{{ ucfirst($seasons['current']['season']) }}</p>
            <p class="text-lg">{{ $seasons['current']['year'] }}</p>
        </div>

        @if (!is_null($seasons['next']))
        <a href="{{ route('anime.season', ['year' => $seasons['next']['year'], 'season' => $seasons['next']['season']]) }}" class="flex flex-col items-center text-link">
            <p class="text-xl">{{ ucfirst($seasons['next']['season']) }}</p>
            <p class="text-sm">{{ $seasons['next']['year'] }}</p>
        </a>
        <a href="{{ route('anime.season', ['year' => $seasons['next']['year'], 'season' => $seasons['next']['season']]) }}" class="flex text-link">
            <x-icons.arrow-right class="w-6 h-6" />
        </a>
        @endif

    </div>
    <div class="flex flex-col gap-8 divide-y divide-gray-400 divide-dashed divide-opacity-50">
        <x-anime-list class="gap-2">

            @forelse ($animes->where('members', '>=', config('anime.season.min_members')) as $anime)
            <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
            @empty
            <div class="text-lg italic">
                {{ __('anime.season.no_anime') }}
            </div>
            @endforelse

        </x-anime-list>
    </div>
</x-app-layout>