<x-app-layout>
    <x-slot name="title">Top Anime</x-slot>
    
    <div class="container mx-auto px-4 pt-12">
        <h2 class="uppercase tracking-wider text-blue-300 text-lg font-semibold">Top Anime</h2>
        <div class="grid grid-cols-2 md:grid-cols-1 mt-4 gap-4">
            @for ($i=1;$i<=50;$i++)
            <div class="relative md:static flex flex-col md:flex-row items-center justify-between bg-gray-200 dark:bg-gray-900 rounded-lg p-2 md:p-4 md:h-auto">
                <div class="absolute left-0 top-0 md:static md:block md:flex-none w-auto md:w-12 px-2 md:px-0 bg-gray-200 dark:bg-gray-900 rounded-lg md:rounded-none text-center text-xl md:text-2xl md:font-bold">
                    #{{ $i }}
                </div>
                <div class="flex flex-row w-full md:w-20 md:pl-4">
                    <img src="https://cdn.myanimelist.net/images/anime/1764/106659.jpg" alt="Anime Poster" />
                </div>
                <div class="grid grid-cols-1 items-center md:items-baseline md:flex md:flex-auto md:flex-col md:ml-3 border-b md:border-none border-dashed border-gray-400 border-opacity-50 pb-2 md:pb-0">
                    <div class="flex flex-row font-semibold text-lg text-center md:text-left py-2 md:py-0 border-b md:border-none border-dashed border-gray-400 border-opacity-50">
                        Anime Title That Is Long Enough To Wrap The Website
                    </div>
                    <div class="flex flex-row items-center justify-center gap-0 md:gap-2 text-center md:text-left text-md md:text-sm pt-2 md:pt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                        </svg>
                        <p class="flex-auto">TV (1000 ep)</p>
                    </div>
                    <div class="flex flex-row items-center justify-center gap-0 md:gap-2 text-center md:text-left text-md md:text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        <p class="flex-auto">Apr 2000 <span class="hidden md:inline"> - Apr 2021</span></p>
                    </div>
                    <div class="flex flex-row items-center justify-center gap-0 md:gap-2 text-center md:text-left text-md md:text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <p class="flex-auto">2.25 jt</p>
                    </div>
                </div>
                <div class="flex-none grid grid-cols-1 md:grid-cols-2">
                    <div class="hidden md:flex flex-row items-center justify-center mx-4">
                        <div class="flex flex-row text-center items-center justify-center gap-2 text-sm py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Tersedia</span>
                        </div>
                    </div>
                    <div class="flex flex-row items-center justify-center pt-2 md:pt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 pr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-xl font-semibold">9.87</span>
                    </div>
                    <div class="flex flex-row items-center justify-center mx-4">
                        <div class="md:hidden flex flex-row text-center items-center justify-center gap-2 text-sm pt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Tersedia</span>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</x-app-layout>