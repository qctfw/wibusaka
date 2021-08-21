<x-app-layout>
    <x-slot name="title">{{ __('anime.genre.title') }}</x-slot>
    <x-slot name="meta_description">{{ __('meta.genre.description_index') }}</x-slot>

    <div class="container px-4 py-12 mx-auto">
        <div class="flex flex-col items-center justify-between gap-8 pb-4 md:flex-row">
            <div class="flex flex-col items-center">
                <x-title>{{ __('anime.genre.title') }}</x-title>
            </div>
        </div>
        <div class="grid items-start justify-center grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4">
            @foreach ($genres as $genre)
            <x-button-link href="{{ route('anime.genre.show', str_replace(' ', '-', strtolower($genre->name))) }}">
                <x-slot name="icon">
                    <x-icons.chevron-right-solid class="w-6 h-6" />
                </x-slot>

                <p class="text-lg font-semibold font-primary md:text-xl">{{ $genre->name }}</p>
            </x-button-link>
            @endforeach
        </div>
    </div>
</x-app-layout>