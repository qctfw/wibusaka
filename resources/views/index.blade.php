<x-app-layout>
    <x-slot name="title">Main Page</x-slot>
    
    <div class="container mx-auto px-4 pt-12">
        <h2 class="uppercase tracking-wider text-blue-300 text-lg font-semibold">Top Anime</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @for ($i=1;$i<=12;$i++)
            <div class="relative flex bg-gray-200 dark:bg-gray-900 rounded-xl p-0 mt-8">
                <img class="w-40 md:w-44 h-auto rounded-l-xl bg-gray-900" src="https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx120209-ep1vPGhTbJc6.png" loading="lazy" alt="Anime Name">
                <div class="grid grid-cols-1 p-2 md:p-3 h-64">
                    <div class="relative overflow-y-auto h-auto scrollbar scrollbar-thumb-gray-700 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
                        <h3 class="text-lg text-center font-semibold pb-0">Anime Name That Is Long Enough To Fit</h3>
                        <div class="grid grid-cols-2 text-sm text-center border-b border-dashed border-gray-700 pb-2">
                            <div class="pt-1">Studio A</div>
                            <div class="pt-1">Light Novel</div>
                            <div class="pt-1 block lg:hidden">? ep</div>
                            <div class="pt-1 hidden lg:block">? episode</div>
                            <div class="pt-1">PG-13</div>
                        </div>
                        <div class="text-sm text-center border-b border-dashed border-gray-700 py-2">
                            Action, Comedy, Harem, Thriller, Pyschological
                        </div>
                        <p class="text-xs pt-2 pb-2">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse magni repudiandae eos ad alias excepturi, error earum facilis asperiores in veniam sed doloremque dicta explicabo placeat corrupti consectetur atque architecto.
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse magni repudiandae eos ad alias excepturi, error earum facilis asperiores in veniam sed doloremque dicta explicabo placeat corrupti consectetur atque architecto.
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Esse magni repudiandae eos ad alias excepturi, error earum facilis asperiores in veniam sed doloremque dicta explicabo placeat corrupti consectetur atque architecto.
                        </p>
                        
                    </div>
                </div>
                @if ($i % 2 == 0)
                    <div class="absolute flex flex-row items-center justify-start gap-2 text-sm bottom-0 left-0 bg-gray-200 bg-opacity-60 dark:bg-gray-900 dark:bg-opacity-50 rounded-tr-lg text-sm px-2 py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Tersedia</span>
                    </div>    
                @else
                    <div class="absolute flex flex-row items-center justify-start gap-2 text-sm bottom-0 left-0 bg-gray-200 bg-opacity-60 dark:bg-gray-900 dark:bg-opacity-50 rounded-tr-lg text-sm px-2 py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>Tidak Tersedia</span>
                    </div>
                @endif
            </div>
            @endfor
        </div>
    </div>
</x-app-layout>