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
<body class="font-sans dark:bg-gray-800 dark:text-white scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
    <x-header-navbar />
    {{ $slot }}
    <x-footer />
    <livewire:scripts />
    <script src="{{ asset('js/app.js') }}"></script>
    {{ $script ?? '' }}
</body>
</html>