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
    <meta name="twitter:site" content="@wibulist" />

    <meta property="og:type" content="{{ $meta_type ?? __('meta.default.type') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $meta_title ?? $title }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:description" content="{{ $meta_description ?? __('meta.default.description') }}" />
    <meta property="og:image" content="{{ asset('img/favicons/wibulist_icon-meta-image-default.png') }}" />

    <title>{{ $title }}{{ !request()->routeIs('index') ? ' - ' . config('app.name') : '' }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicons/wibulist_icon-16x16.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicons/wibulist_icon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('img/favicons/wibulist_icon-64x64.png') }}" />
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicons/wibulist_icon-96x96.png') }}" />
    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('img/favicons/wibulist_icon-128x128.png') }}" />
    <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('img/favicons/wibulist_icon-144x144.png') }}" />
    <link rel="icon" type="image/png" sizes="196x196" href="{{ asset('img/favicons/wibulist_icon-196x196.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('img/favicons/wibulist_icon-apple-touch.png') }}" />

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
<body class="font-sans bg-gray-200 dark:bg-gray-900 dark:text-gray-200 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-300 dark:scrollbar-thumb-gray-500 dark:scrollbar-track-gray-700">
    @if (!request()->routeIs('index'))
    <x-header-navbar />
    @else
    <x-header-index />
    @endif

    {{ $slot }}

    @if (!request()->routeIs('index'))
    <x-footer />
    @endif
    <livewire:scripts />
    <script src="{{ mix('js/app.js') }}"></script>
    {{ $script ?? '' }}
</body>
</html>