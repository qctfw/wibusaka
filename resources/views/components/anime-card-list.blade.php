<div class="relative flex flex-col items-center justify-between p-2 text-emerald-900 transition-colors bg-gray-100 rounded-lg group hover:bg-emerald-100 dark:hover:bg-emerald-800 md:static md:flex-row dark:bg-gray-800 dark:text-emerald-50 md:h-auto">
    @php
        $ranktext = 'text-lg md:text-xl';
        if ($rank <= 10) {
            $ranktext = 'text-2xl md:text-3xl';
        }
        elseif ($rank <= 100) {
            $ranktext = 'text-xl md:text-2xl';
        }
    @endphp
    <div class="absolute top-0 left-0 w-auto px-2 {{ $ranktext }} text-center bg-gray-200 rounded-tl-lg rounded-br-lg md:bg-transparent md:static md:block md:flex-none md:w-12 md:px-0 dark:bg-gray-900 md:rounded-none md:font-bold z-20 group-hover:bg-emerald-200 dark:group-hover:bg-emerald-900">
        <span class="hidden md:inline">#</span>{{ $rank }}
    </div>
    <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="relative flex flex-row items-center w-full anime-cover h-60 md:h-auto md:w-20 md:pl-4">
        <div class="flex flex-col items-center justify-center w-full spinner">
            <i class="animate-spin fa-solid fa-spinner text-lg text-gray-800 dark:text-gray-100"></i>
        </div>
        <img data-src="{{ $anime['images']['webp']['small_image_url'] }}" srcset="{{ $anime['images']['webp']['image_url'] }} 1.6x, {{ $anime['images']['webp']['large_image_url'] }} 1.75x" alt="'{{ $anime['titles']['default'][0] }}' Anime Poster" loading="lazy" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto rounded-lg opacity-0" />
        <div class="absolute inset-x-0 bottom-0 py-1 bg-black bg-opacity-50 md:hidden">
            <h4 class="p-1 text-lg font-semibold leading-tight text-center text-emerald-100 transition-colors duration-200 group-hover:text-emerald-300 dark:group-hover:text-emerald-300">
                {{ $anime['titles']['default'][0] }}
            </h4>
        </div>
    </a>
    <div class="grid items-center flex-auto w-full grid-cols-1 pb-2 border-b border-gray-400 border-opacity-50 border-dashed md:w-auto md:items-baseline md:flex md:flex-auto md:flex-col md:ml-3 md:border-none md:pb-0">
        <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="flex-row items-center justify-center hidden py-2 text-lg font-semibold text-center border-b border-gray-400 border-opacity-50 border-dashed md:flex text-link font-primary md:text-left md:py-0 md:border-none">
            {{ $anime['titles']['default'][0] }}
        </a>
        <div class="flex flex-row items-center justify-center gap-0 pt-2 text-center md:gap-2 md:text-left text-md md:text-sm md:pt-0">
            <div class="flex-none w-4"><i class="flex-none fa-solid fa-video text-sm"></i></div>
            <p class="flex-auto">{{ $anime['type'] ?? '?' }}{{ ($anime['episodes'] > 1) ? ' ('.$anime['episodes'].' ep)' : '' }}</p>
        </div>
        <div class="flex flex-row items-center justify-center gap-0 text-center md:gap-2 md:text-left text-md md:text-sm">
            <div class="flex-none w-4"><i class="flex-none fa-solid fa-calendar-day text-sm"></i></div>
            <p class="flex-auto">
                {{ $anime->airedFromLongFormat() }}
                @if (!is_null($anime['aired_to']) && $anime->airedFromLongFormat() != $anime->airedToLongFormat() && $anime['episodes'] > 1)
                <span class="hidden md:inline"> - {{ $anime->airedToLongFormat() }}</span>
                @endif
            </p>
        </div>
        <div class="flex flex-row items-center justify-center gap-0 text-center md:gap-2 md:text-left text-md md:text-sm">
            <div class="flex-none w-4"><i class="flex-none fa-solid fa-user text-sm"></i></div>
            <p class="flex-auto">{{ abbreviate_number($anime['members']) }}</p>
        </div>
    </div>
    <div class="flex flex-col-reverse items-center justify-center gap-2 pt-2 text-sm text-center md:flex-row">
        @if (!blank($resources))
        <div class="flex flex-row flex-wrap items-center justify-center gap-3 p-2 transition-colors rounded-lg md:mx-4 md:bg-gray-300 md:dark:bg-gray-900 group-hover:bg-emerald-200 dark:group-hover:bg-emerald-900">
            @foreach ($resources as $resource)
            <a href="{{ $resource->link }}" target="_blank" class="w-7 h-7 md:w-6 md:h-6" title="{{ $resource->alternative_note }}">
                <img src="{{ logo_asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
            </a>
            @endforeach
        </div>
        @endif
        <div class="{{ (!$anime['score']) ? 'hidden md:flex' : 'flex'}} flex-row items-center justify-center md:pt-0 md:col-span-2 md:mr-4">
            <i class="fa-solid fa-star pr-1"></i>
            <span class="text-xl font-semibold">{{ $anime['score'] ?? 'T/A' }}</span>
        </div>
    </div>
</div>
