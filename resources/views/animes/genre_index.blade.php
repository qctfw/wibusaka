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
            <a href="{{ route('anime.genre.show', str_replace(' ', '-', strtolower($genre->name))) }}" class="flex items-center justify-between w-full h-16 transition-colors duration-200 bg-gray-200 rounded-xl dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700">
                <div class="flex-auto pl-4">
                    <p class="text-lg font-semibold md:text-xl">{{ $genre->name }}</p>
                </div>
                <div class="flex-none pr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</x-app-layout>