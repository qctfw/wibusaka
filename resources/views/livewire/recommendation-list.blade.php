<div wire:init="loadRecommendations" class="mt-4 md:grid-cols-5">
    @if ($loaded)
        <x-library-scroll class="w-full">
        @forelse ($recommendations as $anime)
        <div class="relative flex flex-col shrink-0 snap-left bg-gray-100 rounded-lg font-primary group dark:bg-gray-800">
            <div class="absolute top-0 left-0 z-20 flex flex-row items-center w-auto gap-1 px-2 text-center bg-gray-200 rounded-tl-lg rounded-br-lg text-md dark:bg-gray-900">
                <x-icons.user-solid class="w-5 h-5" />
                <span>{{ $anime['votes'] }}</span>
            </div>
            <a href="{{ route('anime.show', $anime['entry']['mal_id']) }}" rel="nofollow" class="relative flex flex-row w-full mx-auto text-emerald-100 rounded-lg anime-cover hover:text-emerald-300 dark:hover:text-emerald-300 h-60 md:h-64 lg:h-64 xl:h-72">
                <div class="flex flex-col items-center justify-center w-44 md:w-48 xl:w-52 spinner">
                    <x-icons.spinner class="block w-5 h-5" />
                </div>
                <img data-src="{{ $anime['entry']['images']['webp']['image_url'] }}" alt="{{ $anime['entry']['title'] }} Anime Poster" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto rounded-lg" loading="lazy" />
                <p class="absolute inset-x-0 bottom-0 py-1 font-semibold leading-tight text-center transition-colors duration-200 bg-black bg-opacity-50 border-dashed rounded-b-lg text-md">
                    {{ $anime['entry']['title'] }}
                </p>
            </a>
        </div>
        @empty
        <div class="flex items-center h-12 col-span-3 md:col-span-5">
            <p class="w-full italic text-center">
                {{ __('anime.single.recommendation_empty') }}
            </p>
        </div>
        @endforelse
        </x-library-scroll>
    @else
    <div class="flex items-center justify-center h-12 col-span-3 gap-4 md:col-span-5">
        <x-icons.spinner class="block w-5 h-5" />
        Memuat...
    </div>
    @endif
</div>