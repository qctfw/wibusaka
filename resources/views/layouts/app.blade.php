<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="title" content="{{ $title }} - {{ config('app.name') }}" />
    <meta name="theme-color" content="#6EE7B7" />
    <meta name="keyword" content="anime, wibu, legal, platform, id" />
    <meta name="description" content="{{ $meta_description ?? __('meta.default.description') }}" />
    <meta name="robots" content="{{ $meta_robots ?? 'index, follow' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="google-site-verification" content="{{ config('app.google_site_verification') }}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@wibusaka" />

    <meta property="og:type" content="{{ $meta_type ?? __('meta.default.type') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $meta_title ?? $title }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:description" content="{{ $meta_description ?? __('meta.default.description') }}" />
    <meta property="og:image" content="{{ asset('img/favicons/wibusaka_icon-meta-image-default.png') }}" />

    <title>{{ $title }}{{ !request()->routeIs('index') ? ' - ' . config('app.name') : '' }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicons/wibusaka_icon-16x16.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicons/wibusaka_icon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('img/favicons/wibusaka_icon-64x64.png') }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicons/wibusaka_icon-96x96.png') }}" />
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/favicons/wibusaka_icon-128x128.png') }}" />
    <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('img/favicons/wibusaka_icon-144x144.png') }}" />
    <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('img/favicons/wibusaka_icon-196x196.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('img/favicons/wibusaka_icon-apple-touch.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- Google Fonts - Lato -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"/>
    <!-- Google Fonts - Catamaran -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800;900&display=swap" />
    <!-- Google Fonts - M PLUS 1p -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;500;700&display=swap" />
    <livewire:styles />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.8.1/dist/cdn.min.js" defer></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/brands.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/solid.min.css') }}" />

    @if (!is_null(config('app.analytics_measurement_id')))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.analytics_measurement_id') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '{{ config("app.analytics_measurement_id") }}');
    </script>
    @endif
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <style>
        [x-cloak] {display: none !important;}
    </style>
</head>
<body class="flex flex-col w-screen h-screen gap-8 overflow-x-hidden font-sans bg-gray-200 dark:bg-gray-900 dark:text-gray-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
    @if (request()->routeIs('index'))
    <x-header-index />
    @else
    <x-header-navbar />
    @endif

    <main class="w-full px-4 pt-4 mx-auto md:px-6 xl:px-8 2xl:px-20">
        {{ $slot }}
    </main>

    @if (request()->routeIs('index'))
    <x-footer-main-page />
    @else
    <x-footer />
    @endif
    <livewire:scripts />
    {{ $script ?? '' }}
</body>
</html>
