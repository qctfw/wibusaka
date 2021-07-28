<div wire:init="loadRecommendations" class="grid items-start justify-between grid-cols-3 gap-2 mt-4 md:grid-cols-5">
    @if ($loaded)
        @forelse ($recommendations as $anime)
        <div class="relative flex flex-col bg-gray-200 rounded-lg group dark:bg-gray-900">
            <div class="absolute top-0 left-0 flex flex-row items-center w-auto gap-1 px-2 text-center bg-gray-200 rounded-tl-lg rounded-br-lg text-md dark:bg-gray-900">
                <x-icons.user-solid class="w-5 h-5" />
                <span>{{ $anime['recommendation_count'] }}</span>
            </div>
            <a href="{{ route('anime.show', $anime['mal_id']) }}" class="w-full mx-auto rounded-lg">
                <img src="{{ $anime['image_url'] }}" alt="{{ $anime['title'] }} Anime Poster" class="w-full mx-auto rounded-lg" loading="lazy" />
            </a>
            <a href="{{ route('anime.show', $anime['mal_id']) }}">
                <p class="py-1 font-semibold leading-tight text-center transition-colors duration-200 border-dashed text-md group-hover:text-blue-700 dark:group-hover:text-blue-300">
                    {{ $anime['title'] }}
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
    @else
    <div class="flex items-center justify-center h-12 col-span-3 gap-4 md:col-span-5">
        <x-icons.spinner class="block w-5 h-5" />
        Memuat...
    </div>
    @endif
</div>