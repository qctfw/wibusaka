<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <livewire:styles />
    <script src="https://unpkg.com/alpinejs@3.0.6/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans dark:bg-gray-800 dark:text-white">
    <x-header-navbar />
    {{ $slot }}
    <footer class="mt-4 border-t border-gray-200 footer dark:border-gray-700">
        <div class="container flex flex-col items-center justify-between gap-1 px-4 py-6 mx-auto md:flex-row">
            <div class="flex flex-row items-center gap-4">
                <p>2021 &bull; WibuList</p>
                <div class="flex-row items-center hidden gap-4 text-gray-700 transition-colors duration-150 md:flex dark:text-white">
                    <a href="https://github.com/qctfw/wibulist" target="_blank">
                        <x-icons.github class="w-6 h-6 hover:text-gray-500 dark:hover:text-gray-300" fill="currentColor" />
                    </a>
                    <a href="#" target="_blank">
                        <x-icons.twitter class="w-6 h-6 hover:text-gray-500 dark:hover:text-gray-300" fill="currentColor" />
                    </a>
                </div>
            </div>
            <p>Powered by <a href="https://jikan.moe">Jikan.moe</a> API</p>
            <div class="flex flex-row items-center gap-4 text-gray-700 md:hidden dark:text-white">
                <a href="https://github.com/qctfw/wibulist" target="_blank">
                    <x-icons.github class="w-6 h-6" fill="currentColor" />
                </a>
                <a href="#" target="_blank">
                    <x-icons.twitter class="w-6 h-6" fill="currentColor" />
                </a>
            </div>
        </div>
    </footer>
    <livewire:scripts />
</body>
</html>