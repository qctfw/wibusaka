<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="title" content="{{ $title }} - {{ config('app.name') }}" />
    <meta name="theme-color" content="#2CEAA3" />
    <meta name="keyword" content="anime, wibu, id" />
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, cum." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, cum." />
    <meta property="og:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png" />

    <title>{{ $title }} - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- Google Fonts - Lato -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"/>
    <!-- Google Fonts - Catamaran -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800;900&display=swap" />
    <!-- Google Fonts - M PLUS 1p -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;500;700&display=swap" />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    <livewire:styles />
    <script src="https://unpkg.com/alpinejs@3.0.6/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans bg-gray-100 dark:bg-gray-800 dark:text-white scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
    <x-header-navbar />
    {{ $slot }}
    <x-footer />
    <livewire:scripts />
    <script src="{{ mix('js/app.js') }}"></script>
    {{ $script ?? '' }}
</body>
</html>