<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
 <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
 <meta name="description" content="@yield('description', 'Nexvano Crop Science — інноваційні мікродобрива, вироблені в Іспанії.')">
 <title>@yield('title', 'Nexvano Crop Science')</title>
 <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
 @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
 @include('blocks.header')
 <main>@yield('content')</main>
 @include('blocks.footer')
</body>
</html>
