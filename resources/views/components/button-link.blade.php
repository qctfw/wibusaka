<a {{ $attributes->merge(['class' => 'flex flex-row items-center justify-between max-h-24 p-4 transition-colors duration-200 bg-gray-200 rounded-xl dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700']) }}>
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