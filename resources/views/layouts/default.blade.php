<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="referrer" content="no-referrer">
    @livewireStyles
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <x-sidebar></x-sidebar>
    @if(Session::get('error'))
    <div id="menssage" class="alert alert-danger p-3 text-center">
        {{ Session::get('error') }}
    </div>
    <script>
        setTimeout(function() {
            var menssage = document.getElementById('menssage');
            if (menssage) {
                menssage.style.display = 'none';
            }
        }, 4000);

    </script>
    @endif

    @if(Session::Get('success'))
    <div id="menssage" class="alert alert-success p-3 text-center">
        {{ Session::get('success') }}
    </div>
    <script>
        setTimeout(function() {
            var menssage = document.getElementById('menssage');
            if (menssage) {
                menssage.style.display = 'none';
            }
        }, 4000);

    </script>
    @endif
    
    @yield('content')
    @livewireScripts
</body>
</html>
