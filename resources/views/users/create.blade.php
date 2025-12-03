@extends('layouts.admin')

@section('content')

   <div class="content">
      <div class="content-title">
         <h1 class="page-title">Cadastrar Usuário</h1>
         <a href="{{ route('users.index') }}" class="btn-view-1">Listar</a>
      </div>

      <x-alert />

      <form action="{{ url('/store-users') }}" method="POST" class="form-container">
         @csrf

         <div>
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-input" placeholder="Nome completo" 
               value="{{ old('name') }}">
         </div>
         <br>
         <div>
            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" id="email" class="form-input" placeholder="Email do usuário" 
               value="{{ old('email') }}">
         </div>
         <br>
         <div>
            <label for="password" class="form-label">Senha:</label>
            <input type="text" name="password" id="password" class="form-input" placeholder="Informe uma senha" 
               value="{{ old('password') }}">
         </div>
         <br>

         <input type="submit" value="Cadastrar" class="btn-success">
         
      </form>
   </div>

@endsection