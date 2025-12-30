<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">

    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet">
</head>

<body>

    {{ $slot }}

</body>
</html>