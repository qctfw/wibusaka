<x-app-layout>
    <x-slot name="title">{{ __('anime.schedule.title') }} Hari {{ $active_day }}</x-slot>
    <x-slot name="meta_title">{{ __('meta.schedule.description') }}</x-slot>

    <div class="flex flex-col items-center justify-between gap-2 pb-4 md:flex-row">
        <div class="flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
            <x-title>{{ __('anime.schedule.title') }} Hari {{ $active_day }}</x-title>
        </div>
        <div class="relative inline-block w-32" x-data="{}" x-init="$refs.dayselector.value = '{{ request('day') }}'">
            <select
            x-ref="dayselector"
            x-on:change="window.location.href = '{{ route('anime.schedule', [], false) }}/' + $event.target.value;"
            class="w-full h-10 px-4 text-lg rounded-md appearance-none bg-emerald-100 dark:bg-gray-800 focus:outline-none focus:ring focus:ring-emerald-300">
                <option value="monday">Senin</option>
                <option value="tuesday">Selasa</option>
                <option value="wednesday">Rabu</option>
                <option value="thursday">Kamis</option>
                <option value="friday">Jum'at</option>
                <option value="saturday">Sabtu</option>
                <option value="sunday">Minggu</option>
            </select>
            <div class="absolute inset-y-0 right-2 pointer-events-none flex items-center">
                <x-icons.chevron-down-solid class="w-6 h-6" />
            </div>
        </div>
    </div>

    @if ($animes->isNotEmpty()) <p class="italic w-full mb-2">&bull; {{ __('anime.schedule.broadcast_disclaimer') }}</p> @endif

    <x-anime-list-schedule :animes="$animes" :resources="$resources" />
</x-app-layout>
