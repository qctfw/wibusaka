<div class="flex flex-row items-center justify-center gap-4">
    @if ($current > 1 && $total > 5)
    <a href="?page=1" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-green-700">
        <x-icons.chevron-double-left-solid class="w-5 h-5" />
    </a>
    <a href="?page={{$current - 1}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-green-700">
        <x-icons.chevron-left-solid class="w-5 h-5" />
    </a>
    @endif

    @foreach ($links as $link)
    @if ($current == $link)
    <div class="flex items-center justify-center w-10 h-10 p-2 text-lg select-none font-semibold text-green-700 transition-colors bg-gray-100 rounded-lg dark:text-green-300 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-green-700">{{ $link }}</div>
    @else
    <a href="?page={{$link}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg select-none font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-green-700">{{ $link }}</a>
    @endif
    @endforeach
    
    @if ($current < $total && $total > 5)
    <a href="?page={{$current + 1}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-green-700">
        <x-icons.chevron-right-solid class="w-5 h-5" />
    </a>
    <a href="?page={{$total}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-green-700">
        <x-icons.chevron-double-right-solid class="w-5 h-5" />
    </a>
    @endif
</div>