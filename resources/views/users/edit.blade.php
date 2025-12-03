@extends('layouts.admin')

@section('content')

   <div class="content">
      <div class="content-title">
         <h1 class="page-title">Editar Usuário</h1>
         <span>
            <a href="{{ route('users.index') }}" class="btn-view-1">Listar</a>
            <a href="{{ route('users.show', ['user' => $user]) }}" class="btn-primary">Visualizar</a>
         </span>
      </div>

      <x-alert />

      <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" class="form-container">
         @method('PUT')
         @csrf

         <div>
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $user->name) }}">
         </div>
         <br>
         <div>
            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" id="email" class="form-input" value="{{ old('email', $user->email) }}">
         </div>
         <br>

         <input type="submit" value="Salvar" class="btn-warning">
         
      </form>
   </div>

@endsection