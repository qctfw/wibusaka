<x-app-layout>
    <x-slot name="title">Halaman Utama</x-slot>
    <x-slot name="meta_title">{{ __('meta.default.title') }}</x-slot>

    <div class="flex flex-col gap-8">
        @foreach ($sections as $section)
        <div class="flex flex-col gap-2">
            <x-title>
                <a href="{{ $section['route'] }}" class="text-link text-link-underline dark:text-emerald-200">{{ $section['title'] }}</a>
                <i class="inline-block ml-2 fa-solid fa-chevron-right text-sm"></i>
            </x-title>
            @if ($section['component'] == 'anime-card-cover')
            <x-library-scroll>
                @foreach ($section['animes'] as $anime)
                <x-anime-card-cover :anime="$anime" :resources="$resources[$anime['mal_id']] ?? null" class="shrink-0 w-44 md:w-48 xl:w-52 snap-center" />
                @endforeach
            </x-library-scroll>
            @elseif ($section['component'] == 'anime-list-schedule')
            @if ($section['animes']->isNotEmpty())
            <ul class="list-disc italic w-full mb-2">
                @foreach (__('anime.schedule.broadcast_disclaimers') as $disclaimer)
                <li>{{ $disclaimer }}</li>
                @endforeach
            </ul>
            @endif
            <x-anime-list-schedule :animes="$section['animes']" :resources="$resources" />
            @endif
        </div>
        @endforeach
    </div>
</x-app-layout>
