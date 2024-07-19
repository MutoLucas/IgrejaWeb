<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="referrer" content="no-referrer">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <x-sidebar></x-sidebar>
        @yield('content')
</body>
</html>
