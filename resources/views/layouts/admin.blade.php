<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cadastrar Usuário</title>

   @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <div class="main-container">
        <div class="header">
            <div class="content-header">
                <h2 class="title-logo"><a href="{{ route('dashboard') }}">EasyFast</a></h2>
                <ul class="list-nav-link">
                <li class="nav-link"><a href="{{ route('users.index') }}">Usuários</a></li>
                <li class="nav-link"><a href="{{ route('dashboard') }}">Sair</a></li>
                </ul>
            </div>
        </div>

        @yield('content')
    </div>

</body>
</html>