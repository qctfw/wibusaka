<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $code }} - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- Google Fonts - Amiko -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Amiko:wght@400;600;700&display=swap" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>
<body class="font-sans dark:bg-gray-800 dark:text-white">
    <article class="flex flex-col items-center justify-center h-screen gap-4">
        <h1 class="font-bold text-7xl">{{ $code }}</h1>
        <p>{{ $message }} &bull; Kembali ke <a href="{{ route('index') }}" class="font-semibold hover:underline">halaman utama</a>.</p>
        <p>- {{ config('app.name') }} -</p>
    </article>
</body>
</html>