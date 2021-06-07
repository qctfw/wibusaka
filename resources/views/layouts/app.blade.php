<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-sans dark:bg-gray-800 dark:text-white">
    <nav class="border-b border-gray-200 dark:border-gray-700">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
            <ul class="flex flex-col md:flex-row items-center">
                <li class="mt-0">
                    <a href="#" class="font-bold text-xl">Logo</a>
                </li>
                <li class="ml-6 mt-0">
                    <a href="#" class="font-medium hover:text-blue-300">Top Anime</a>
                </li>
                <li class="ml-6 mt-0">
                    <a href="#" class="font-medium hover:text-blue-300">Anime Musim Ini</a>
                </li>
                <li class="ml-6 mt-0">
                    <a href="#" class="font-medium hover:text-blue-300">Anime Musim Depan</a>
                </li>
            </ul>
            <div class="flex flex-col md:flex-row items-center">
                <div class="relative mt-3 md:mt-0">
                    <input type="text" class="bg-gray-300 dark:bg-gray-900 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:ring focus:border-blue-300" placeholder="Cari...">
                    <div class="absolute top-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-gray-500 dark:text-white mt-1.5 ml-2" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{ $slot }}
</body>
</html>