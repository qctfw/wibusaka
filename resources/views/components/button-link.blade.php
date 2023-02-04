<a {{ $attributes->merge(['class' => 'flex flex-row items-center justify-between max-h-24 p-4 transition-colors duration-200 bg-emerald-700 text-emerald-50 rounded-xl dark:bg-gray-700 dark:bg-opacity-40 hover:bg-emerald-300 hover:text-emerald-800 dark:hover:bg-emerald-700 dark:hover:text-emerald-50']) }}>
    @isset($img)
    <div class="flex flex-none w-16 mx-auto">
        <img src="{{ $img }}" alt="Icon" class="mx-auto">
    </div>
    @endisset
    @isset($customImg)
    {{ $customImg }}
    @endisset
    <div class="flex flex-col flex-auto">
        {{ $slot }}
    </div>
    @isset($icon)
    {{ $icon }}
    @else
    <i class="fa-solid fa-up-right-from-square text-lg"></i>
    @endisset
</a>
