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

      <form action="{{ route('users.updatePassword', ['user' => $user->id]) }}" method="POST" class="form-container">
         @method('PUT')
         @csrf

         <div>
            <label for="password" class="form-label">Senha:</label>
            <input type="password" name="password" id="password" class="form-input" value="">
         </div>
         <br>

         <input type="submit" value="Salvar" class="btn-warning">
         
      </form>
   </div>

@endsection