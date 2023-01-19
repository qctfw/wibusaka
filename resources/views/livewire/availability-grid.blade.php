<div wire:init="loadResources" class="grid items-center grid-cols-1 gap-4 mt-4 lg:grid-cols-2 2xl:grid-cols-3 rounded-xl">
    @if ($loaded)
        @forelse ($resources as $resource)
        <x-button-link href="{{ $resource->link }}" target="_blank" :img="logo_asset($resource->platform->icon_path)">
            <div class="flex flex-row items-center gap-2 pl-2 text-lg font-semibold font-primary md:pl-4">
                <p>{{ $resource->platform->name }}</p>
                @if ($resource->paid)
                    <i class="fa-solid fa-coins text-lg"></i>
                @endif
            </div>
            <p class="pl-2 text-sm italic md:pl-4">{{ $resource->note }}</p>
        </x-button-link>
        @empty
        <div class="flex items-center h-12 col-span-3 p-4">
            <p class="w-full italic text-center">
                {{ __('anime.single.availability_empty') }}
                <i class="inline-block fa-solid fa-face-frown"></i>
            </p>
        </div>
        @endforelse
    @else
    <div class="flex items-center justify-center h-12 col-span-3 gap-4">
        <i class="animate-spin fa-solid fa-spinner text-lg text-gray-800 dark:text-gray-100"></i>
        Memuat...
    </div>
    @endif
</div>
