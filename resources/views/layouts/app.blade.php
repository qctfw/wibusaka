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
                        <!-- css.gg/search -->
                        <svg width="24" height="24" viewBox="0 0 24 24" class="fill-current w-4 text-gray-800 dark:text-white mt-1 ml-2" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.319 14.4326C20.7628 11.2941 20.542 6.75347 17.6569 3.86829C14.5327 0.744098 9.46734 0.744098 6.34315 3.86829C3.21895 6.99249 3.21895 12.0578 6.34315 15.182C9.22833 18.0672 13.769 18.2879 16.9075 15.8442C16.921 15.8595 16.9351 15.8745 16.9497 15.8891L21.1924 20.1317C21.5829 20.5223 22.2161 20.5223 22.6066 20.1317C22.9971 19.7412 22.9971 19.1081 22.6066 18.7175L18.364 14.4749C18.3493 14.4603 18.3343 14.4462 18.319 14.4326ZM16.2426 5.28251C18.5858 7.62565 18.5858 11.4246 16.2426 13.7678C13.8995 16.1109 10.1005 16.1109 7.75736 13.7678C5.41421 11.4246 5.41421 7.62565 7.75736 5.28251C10.1005 2.93936 13.8995 2.93936 16.2426 5.28251Z" fill="currentColor" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{ $slot }}
</body>
</html>