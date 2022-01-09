<div x-show="{{ $trigger ?? 'open' }}"
    x-on:keydown.escape.window="open = false"
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-out duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    {{ $attributes->merge(['class' => 'fixed inset-0 flex items-center justify-center px-4 bg-white bg-opacity-50 md:px-0 dark:bg-gray-700 dark:bg-opacity-50']) }}>
    <div x-show="{{ $trigger ?? 'open' }}"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="flex flex-col w-screen max-h-screen p-6 bg-white rounded-lg shadow-2xl md:w-1/2 dark:bg-gray-800">
        <div class="flex justify-between mb-4 dark:text-gray-200">
            {{ $header }}
        </div>
        <div class="scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
            {{ $slot }}
        </div>
    </div>
</div>