<x-app-layout>
    <x-slot name="title">Halaman Utama</x-slot>
    <x-slot name="meta_title">{{ __('meta.default.title') }}</x-slot>

    <div class="flex flex-col gap-6">
        @foreach ($sections as $section)
        <div class="flex flex-col gap-2">
            <x-title>
                <a href="{{ $section['route'] }}">{{ $section['title'] }} <x-icons.chevron-right-solid class="inline-block w-6 h-6" /></a>
            </x-title>
            <x-library-scroll>
                @foreach ($section['animes'] as $anime)
                <x-anime-card-cover :anime="$anime" :resources="$resources[$anime['mal_id']] ?? null" class="shrink-0 w-44 md:w-48 xl:w-52 snap-center" />
                @endforeach
            </x-library-scroll>
        </div>
        @endforeach
    </div>
</x-app-layout>