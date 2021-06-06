<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Main Site</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-sans dark:bg-gray-800 dark:text-white">
    {{ $slot }}
</body>
</html>