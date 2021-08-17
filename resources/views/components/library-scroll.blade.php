<div {{ $attributes->merge(['class' => 'relative']) }} x-data="{scroll: 0}">
    <div class="flex flex-row items-end w-full gap-8 overflow-auto transition-all flex-nowrap snap snap-x snap-mandatory overflow-smooth" x-ref="slider" x-on:scroll="scroll = $refs.slider.scrollLeft">
        {{ $slot }}
    </div>
    <button
        class="absolute hidden md:flex items-center justify-center w-12 h-12 bg-gray-300 dark:bg-gray-900 rounded-full shadow-md inset-y-1/2 -left-5 transition-colors bg-opacity-80 ring-0 hover:bg-opacity-100 hover:bg-gray-400 dark:hover:bg-gray-600 disabled:opacity-0"
        x-bind:disabled="scroll == 0"
        x-on:click=" $refs.slider.scrollLeft -= $refs.slider.clientWidth - ($refs.slider.clientWidth / $refs.slider.childElementCount)">
        <x-icons.chevron-left-solid class="w-8 h-8" />
    </button>
    <button
        class="absolute hidden md:flex items-center justify-center w-12 h-12 bg-gray-300 dark:bg-gray-900 rounded-full shadow-md inset-y-1/2 -right-5 transition-colors bg-opacity-80 ring-0 hover:bg-opacity-100 hover:bg-gray-400 dark:hover:bg-gray-600 disabled:opacity-0"
        x-bind:disabled="scroll == $refs.slider.scrollWidth - $refs.slider.clientWidth"
        x-on:click="$refs.slider.scrollLeft += $refs.slider.clientWidth - ($refs.slider.clientWidth / $refs.slider.childElementCount)">
        <x-icons.chevron-right-solid class="w-8 h-8" />
    </button>
</div>