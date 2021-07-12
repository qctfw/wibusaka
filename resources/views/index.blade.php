<x-app-layout>
    <x-slot name="title">Top Anime</x-slot>

    <div class="container flex flex-col gap-4 px-4 pt-12 mx-auto">
        <div class="flex flex-col gap-2">
            <a href="{{ route('anime.top.popular') }}">
                <x-title>Top Anime</x-title>
            </a>
            <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-6">
                @foreach ($top_animes as $anime)
                <x-anime-card-cover :anime="$anime" :resources="$top_resources[$anime['mal_id']]" />
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <a href="{{ route('anime.top.upcoming') }}">
                <x-title>Anime Paling Dinantikan</x-title>
            </a>
            <div class="grid items-end grid-cols-2 gap-8 py-4 md:grid-cols-3 lg:grid-cols-6">
                @foreach ($upcoming_animes as $anime)
                <x-anime-card-cover :anime="$anime" />
                @endforeach
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            const allImages = document.getElementsByClassName('anime-cover');
            
            for (let i = 0; i < allImages.length; i++) {
                const imgCover = allImages[i].getElementsByTagName('img')[0];
                const imgPreload = allImages[i].getElementsByClassName('spinner')[0];

                imgCover.onload = function () {
                    imgCover.classList.remove('absolute', 'opacity-0');
                    imgPreload.remove();
                }

                imgCover.src = imgCover.getAttribute('data-src');
            }
        </script>
    </x-slot>
</x-app-layout>