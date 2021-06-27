<div class="flex flex-row items-center justify-center gap-4">
    @if ($current > 1 && $total > 5)
    <a href="?page=1" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-200 rounded-lg dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
    </a>
    <a href="?page={{$current - 1}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-200 rounded-lg dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </a>
    @endif

    @foreach ($links as $link)
    @if ($current == $link)
    <div class="flex items-center justify-center w-10 h-10 p-2 text-lg select-none font-semibold text-blue-700 transition-colors bg-gray-200 rounded-lg dark:text-blue-300 dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700">{{ $link }}</div>
    @else
    <a href="?page={{$link}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg select-none font-semibold transition-colors bg-gray-200 rounded-lg dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700">{{ $link }}</a>
    @endif
    @endforeach
    
    @if ($current < $total && $total > 5)
    <a href="?page={{$current + 1}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-200 rounded-lg dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    </a>
    <a href="?page={{$total}}" class="flex items-center justify-center w-10 h-10 p-2 text-lg font-semibold transition-colors bg-gray-200 rounded-lg dark:bg-gray-900 hover:bg-gray-300 dark:hover:bg-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    </a>
    @endif
</div>