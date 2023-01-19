<x-app-layout>
    <x-slot name="title">{{ __('anime.schedule.title') }} Hari {{ $active_day }}</x-slot>
    <x-slot name="meta_title">{{ __('meta.schedule.description') }}</x-slot>

    <div class="flex flex-col items-center justify-between gap-2 pb-4 md:flex-row">
        <div class="flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
            <x-title>{{ __('anime.schedule.title') }} Hari {{ $active_day }}</x-title>
        </div>
        <x-dropdown>
            <x-slot name="menu">
                <button class="flex flex-row w-36 h-12 px-3 items-center justify-between rounded-md transition duration-100 text-emerald-50 bg-emerald-800 hover:text-emerald-900 hover:bg-emerald-300 group-focus-within:text-emerald-900 group-focus-within:bg-emerald-300 dark:hover:text-white dark:text-emerald-300 dark:bg-gray-800 dark:hover:bg-emerald-800 dark:group-focus-within:bg-emerald-800 dark:group-focus-within:text-white">
                    <div class="text-lg">Pilih Hari</div>
                    <i class="fa-solid fa-chevron-down text-md"></i>
                </button>
            </x-slot>
            <div class="absolute flex flex-col w-40 rounded-md bg-emerald-900 border border-emerald-200 border-opacity-30 text-emerald-50 dark:text-emerald-300 dark:bg-gray-800 shadow-lg outline-none" role="menu">
                <a href="{{ route('anime.schedule', ['day' => 'monday']) }}" class="px-4 py-2 transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800 rounded-t-md">Senin</a>
                <a href="{{ route('anime.schedule', ['day' => 'tuesday']) }}" class="px-4 py-2 transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800">Selasa</a>
                <a href="{{ route('anime.schedule', ['day' => 'wednesday']) }}" class="px-4 py-2 transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800">Rabu</a>
                <a href="{{ route('anime.schedule', ['day' => 'thursday']) }}" class="px-4 py-2 transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800">Kamis</a>
                <a href="{{ route('anime.schedule', ['day' => 'friday']) }}" class="px-4 py-2 transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800">Jum'at</a>
                <a href="{{ route('anime.schedule', ['day' => 'saturday']) }}" class="px-4 py-2 transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800">Sabtu</a>
                <a href="{{ route('anime.schedule', ['day' => 'sunday']) }}" class="px-4 py-2 transition duration-75 hover:text-emerald-900 hover:bg-emerald-300 dark:hover:text-white dark:hover:bg-emerald-800 rounded-b-md">Minggu</a>
            </div>
        </x-dropdown>
    </div>

    @if ($animes->isNotEmpty()) <p class="italic w-full mb-2">&bull; {{ __('anime.schedule.broadcast_disclaimer') }}</p> @endif

    <x-anime-list-schedule :animes="$animes" :resources="$resources" />
</x-app-layout>
