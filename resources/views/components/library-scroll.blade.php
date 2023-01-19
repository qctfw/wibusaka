@props(['id' => uniqid()])
<div {{ $attributes->merge(['class' => 'relative']) }} x-data="{scroll: 0}" id="slider-{{ $id }}">
    <div class="flex flex-row items-stretch w-full gap-8 overflow-auto transition-all flex-nowrap snap snap-x snap-mandatory overflow-smooth" x-ref="slider" x-on:scroll="scroll = $refs.slider.scrollLeft">
        {{ $slot }}
    </div>
    <button
        class="absolute items-center justify-center hidden w-12 h-12 transition-colors bg-emerald-700 rounded-full shadow-md md:flex text-emerald-50 dark:bg-gray-700 dark:text-emerald-50 inset-y-1/2 -left-5 ring-0 hover:bg-opacity-100 hover:bg-emerald-300 hover:text-emerald-700 dark:hover:text-emerald-200 dark:hover:bg-emerald-800 disabled:opacity-0"
        x-bind:disabled="scroll <= 1"
        x-on:click="$refs.slider.scrollLeft -= ($refs.slider.offsetWidth - ($refs.slider.offsetWidth / ($refs.slider.childElementCount))) / 1.2">
        <i class="fa-solid fa-chevron-left text-xl"></i>
    </button>
    <button
        class="absolute items-center justify-center hidden w-12 h-12 transition-colors bg-emerald-700 rounded-full shadow-md md:flex text-emerald-50 dark:bg-gray-700 dark:text-emerald-50 inset-y-1/2 -right-5 ring-0 hover:bg-opacity-100 hover:bg-emerald-300 hover:text-emerald-700 dark:hover:text-emerald-200 dark:hover:bg-emerald-800 disabled:opacity-0"
        x-bind:disabled="scroll == $refs.slider.scrollWidth - $refs.slider.offsetWidth"
        x-on:click="$refs.slider.scrollLeft += ($refs.slider.offsetWidth - ($refs.slider.offsetWidth / ($refs.slider.childElementCount))) / 1.2">
        <i class="fa-solid fa-chevron-right text-xl"></i>
    </button>
    <script>
        new ResizeObserver(function () {
            document.getElementById('slider-{{ $id }}').querySelector('[x-ref=slider]').scrollLeft = 1
        }).observe(document.getElementById('slider-{{ $id }}'))
    </script>
</div>
