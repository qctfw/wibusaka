<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://unpkg.com/alpinejs@3.0.6/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans dark:bg-gray-800 dark:text-white">
    <x-header-navbar />
    {{ $slot }}
    <footer class="footer border-t border-gray-200 dark:border-gray-700 mt-4">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-6">
            <p>2021 &bull; WibuList</p>
            <p>Powered by <a href="https://jikan.moe">Jikan.moe</a> API</p>
        </div>
    </footer>
</body>
</html>