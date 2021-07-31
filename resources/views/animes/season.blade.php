<x-app-layout>
    <x-slot name="title">{{ __('anime.season.title') }} {{ $seasons['current']['season'] . ' ' . $seasons['current']['year'] }}</x-slot>
    
    <div class="container px-4 pt-12 mx-auto">
        <div class="flex flex-row items-center justify-center gap-8 pb-4 font-primary">

            @if (!is_null($seasons['previous']))
            <a href="{{ route('anime.season', ['year' => $seasons['previous']['year'], 'season' => $seasons['previous']['season']]) }}" class="flex transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <x-icons.arrow-left class="w-6 h-6" />
            </a>
            <a href="{{ route('anime.season', ['year' => $seasons['previous']['year'], 'season' => $seasons['previous']['season']]) }}" class="flex flex-col items-center transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <p class="text-xl">{{ ucfirst($seasons['previous']['season']) }}</p>
                <p class="text-sm">{{ $seasons['previous']['year'] }}</p>
            </a>
            @endif

            <div class="flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
                <p class="text-3xl">{{ $seasons['current']['season'] }}</p>
                <p class="text-lg">{{ $seasons['current']['year'] }}</p>
            </div>

            @if (!is_null($seasons['next']))
            <a href="{{ route('anime.season', ['year' => $seasons['next']['year'], 'season' => $seasons['next']['season']]) }}" class="flex flex-col items-center transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <p class="text-xl">{{ ucfirst($seasons['next']['season']) }}</p>
                <p class="text-sm">{{ $seasons['next']['year'] }}</p>
            </a>
            <a href="{{ route('anime.season', ['year' => $seasons['next']['year'], 'season' => $seasons['next']['season']]) }}" class="flex transition-colors hover:text-blue-700 dark:hover:text-blue-300">
                <x-icons.arrow-right class="w-6 h-6" />
            </a>
            @endif

        </div>
        <div class="flex flex-col gap-4 divide-y divide-gray-400 divide-dashed divide-opacity-50">
            <div class="flex flex-col gap-2">
                <x-subtitle>
                    TV <span class="text-xs normal-case">({{ abbreviate_number(config('anime.season.minimum.tv')) }}+ member)</span>
                </x-subtitle>
                <div class="grid items-start grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($animes->where('type', 'TV')->where('continuing', false)->where('members', '>=', config('anime.season.minimum.tv')) as $anime)
                    <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
                    @empty
                    <div class="text-lg italic">
                        {{ __('anime.season.no_anime') }}
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="flex flex-col gap-2 pt-4">
                <x-subtitle>
                    TV
                    <span class="normal-case">(Lanjutan)</span>
                    <span class="text-xs normal-case">({{ abbreviate_number(config('anime.season.minimum.tv_continuing')) }}+ member)</span>
                </x-subtitle>
                <div class="grid items-start grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($animes->where('type', 'TV')->where('continuing', true)->where('members', '>=', config('anime.season.minimum.tv_continuing')) as $anime)
                    <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
                    @empty
                    <div class="text-lg italic">
                        {{ __('anime.season.no_anime') }}
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="flex flex-col gap-2 pt-4">
                <x-subtitle>
                    ONA <span class="text-xs normal-case">({{ abbreviate_number(config('anime.season.minimum.ona')) }}+ member)</span>
                </x-subtitle>
                <div class="grid items-start grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($animes->where('type', 'ONA')->where('members', '>=', config('anime.season.minimum.ona')) as $anime)
                    <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
                    @empty
                    <div class="text-lg italic">
                        {{ __('anime.season.no_anime') }}
                    </div>
                    @endforelse
                </div>
                
            </div>
            <div class="flex flex-col gap-2 pt-4">
                <x-subtitle>
                    OVA <span class="text-xs normal-case">({{ abbreviate_number(config('anime.season.minimum.ova')) }}+ member)</span>
                </x-subtitle>
                <div class="grid items-start grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($animes->where('type', 'OVA')->where('members', '>=', config('anime.season.minimum.ova')) as $anime)
                    <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
                    @empty
                    <div class="text-lg italic">
                        {{ __('anime.season.no_anime') }}
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="flex flex-col gap-2 pt-4">
                <x-subtitle>
                    Movie <span class="text-xs normal-case">({{ abbreviate_number(config('anime.season.minimum.movie')) }}+ member)</span>
                </x-subtitle>
                <div class="grid items-start grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($animes->where('type', 'Movie')->where('members', '>=', config('anime.season.minimum.movie')) as $anime)
                    <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
                    @empty
                    <div class="text-lg italic">
                        {{ __('anime.season.no_anime') }}
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="flex flex-col gap-2 pt-4">
                <x-subtitle>
                    Special <span class="text-xs normal-case">({{ abbreviate_number(config('anime.season.minimum.special')) }}+ member)</span>
                </x-subtitle>
                <div class="grid items-start grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($animes->where('type', 'Special')->where('members', '>=', config('anime.season.minimum.special')) as $anime)
                    <x-anime-card :anime="$anime" :resources="$resources[$anime['mal_id']]" />
                    @empty
                    <div class="text-lg italic">
                        {{ __('anime.season.no_anime') }}
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>