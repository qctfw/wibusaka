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
        <div class="container flex flex-col items-center justify-between px-4 py-6 mx-auto md:flex-row">
            <p>2021 &bull; WibuList</p>
            <p>Powered by <a href="https://jikan.moe">Jikan.moe</a> API</p>
        </div>
    </footer>
    <livewire:scripts />
</body>
</html>