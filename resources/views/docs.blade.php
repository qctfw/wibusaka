<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="title" content="WibuSaka API Documentation" />
    <meta name="theme-color" content="#6EE7B7" />
    <meta name="keyword" content="anime, wibu, legal, platform, id" />
    <meta name="description" content=" " />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="google-site-verification" content="{{ config('app.google_site_verification') }}" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@wibusaka" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="WibuSaka API Documentation" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:description" content=" " />
    <meta property="og:image" content="{{ asset('img/favicons/wibusaka_icon-meta-image-default.png') }}" />

    <title>API Documentation - {{ config('app.name') }}</title>

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
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <main id="redoc-container"></main>
    <script src="https://cdn.jsdelivr.net/npm/redoc@next/bundles/redoc.standalone.js"> </script>
    <script>
        Redoc.init("{{ config('anime.asset.openapi') }}", {
            theme: {
                "typography": {
                    "fontSize": "16px",
                    "fontFamily": "Lato, Roboto, sans-serif",
                    "optimizeSpeed": true,
                    "smoothing": "antialiased",
                    "headings": {
                        "fontFamily": "Catamaran, Roboto, sans-serif",
                        "fontWeight": "bold",
                        "lineHeight": "1em"
                    },
                    "code": {
                        "fontFamily": "Courier New, Courier, monospace",
                    }
                }
            }
        }, document.getElementById('redoc-container'));
    </script>
</body>
</html>