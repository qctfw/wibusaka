<x-app-layout>
    <x-slot name="title">Genre Anime</x-slot>

    <div class="container px-4 py-12 mx-auto">
        <div class="flex flex-col items-center justify-between gap-8 pb-4 md:flex-row">
            <div class="flex flex-col items-center">
                <x-title>Genre Anime</x-title>
            </div>
        </div>
        <div class="grid items-start justify-center grid-cols-2 gap-4 md:grid-cols-3 xl:grid-cols-4">
            @foreach ($genres as $genre)
            <x-button-link :link="route('anime.genre.show', str_replace(' ', '-', strtolower($genre->name)))">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </x-slot>

                <p class="text-lg font-semibold md:text-xl">{{ $genre->name }}</p>
            </x-button-link>
            @endforeach
        </div>
    </div>
</x-app-layout>