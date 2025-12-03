<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Relatório de Usuário</title>

   @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
   <div class="">
      <label for="id">ID:</label>
      <span>{{ $user->id }}</span>
      <br>
      <label for="name">Nome:</label>
      <span>{{ $user->name }}</span>
      <br>
      <label for="email">E-Mail:</label>
      <span>{{ $user->email }}</span>
      <br>
      <label for="created_at">Data do cadastro:</label>
      <span>{{ $user->created_at }}</span>
   </div>

</body>
</html>