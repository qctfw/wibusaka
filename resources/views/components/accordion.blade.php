<div x-data="{ accordionOpen: false }" {{ $attributes->merge(['class' => 'flex flex-col w-full gap-2']) }}>
    <div class="flex flex-row items-center justify-between w-full p-2 transition-colors bg-white bg-opacity-0 border-b border-green-800 cursor-pointer select-none hover:bg-opacity-10 rounded" x-on:click="accordionOpen = !accordionOpen">
        <h3 class="text-xl font-semibold">{{ $title }}</h3>
        <x-icons.chevron-down-solid class="w-8 h-8 transform" x-bind:class="{'rotate-0': !accordionOpen, 'rotate-180': accordionOpen}" />
    </div>
    <div
        x-show="accordionOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-out duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2"
    >
        {{ $slot }}
    </div>
</div>
