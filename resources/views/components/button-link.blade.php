<a {{ $attributes->merge(['class' => 'flex flex-row items-center justify-between max-h-24 p-4 transition-colors duration-200 bg-green-700 text-green-50 rounded-xl dark:bg-gray-700 dark:bg-opacity-40 hover:bg-green-300 hover:text-green-800 dark:hover:bg-green-700 dark:hover:text-green-50']) }}>
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
    <x-icons.external-link-solid class="w-6 h-6" />
    @endisset
</a>