<div class="flex flex-row items-center justify-center gap-4">
    @if ($current > 1 && $total > 5)
    <a href="?page=1" class="flex flex-row items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-emerald-700">
        <i class="fa-solid fa-chevron-left text-sm"></i>
        <i class="fa-solid fa-chevron-left text-sm -ml-1"></i>
    </a>
    <a href="?page={{$current - 1}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-emerald-700">
        <i class="fa-solid fa-chevron-left text-sm"></i>
    </a>
    @endif

    @foreach ($links as $link)
    @if ($current == $link)
    <div class="flex items-center justify-center w-10 h-10 p-2 text-lg select-none font-semibold text-emerald-700 transition-colors bg-gray-100 rounded-lg dark:text-emerald-300 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-emerald-700">{{ $link }}</div>
    @else
    <a href="?page={{$link}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg select-none font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-emerald-700">{{ $link }}</a>
    @endif
    @endforeach

    @if ($current < $total && $total > 5)
    <a href="?page={{$current + 1}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-emerald-700">
        <i class="fa-solid fa-chevron-right text-sm"></i>
    </a>
    <a href="?page={{$total}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-emerald-700">
        <i class="fa-solid fa-chevron-right text-sm"></i>
        <i class="fa-solid fa-chevron-right text-sm -ml-1"></i>
    </a>
    @endif
</div>
