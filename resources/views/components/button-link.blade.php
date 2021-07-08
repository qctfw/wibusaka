<a href="{{ $link }}" target="_blank" class="flex flex-row items-center justify-between max-h-24 p-4 transition-colors duration-200 bg-gray-200 rounded-xl dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700">
    @isset($img)
    <div class="flex flex-none w-16 mx-auto">
        <img src="{{ $img }}" alt="Icon" class="mx-auto">
    </div>
    @endisset
    <div class="flex flex-col flex-auto">
        {{ $slot }}
    </div>
    @isset($icon)
    {{ $icon }}
    @else
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 20 20" fill="currentColor">
        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
    </svg>
    @endisset
</a>