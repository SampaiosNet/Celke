@extends('layouts.admin')

@section('content')

   <div class="content">
      <div class="content-title">
         <h1 class="page-title">Listar os Usuários</h1>
         <a href="{{ route('users.create') }}" class="btn-success">Cadastrar</a>
      </div>

      <x-alert />

      <form class='pb-3 grid xl:grid-cols-5 md:grid-cols-2 gap-2 items-end'>
         <input type="text" name='name' value='{{ $name }}' class='form-input' placeholder="Digite o nome">
         <input type="text" name='email' value='{{ $email }}' class='form-input' placeholder="Digite o email">
         <div class='flex gap-1'>
            <button type="submit" class='btn-primary'>
               <span>Pesquisar</span>
            </button>
            <a href="{{ route('users.index') }}" class='btn-warning'>
               <span>Limpar</span>
            </a>
         </div>
      </form>

      <div class="table-container">
         <table class="table">
            <thead>
               <tr class="table-header">
                  <th class="table-header">ID</th>
                  <th class="table-header">Nome</th>
                  <th class="table-header">E-Mail</th>
                  <th class="table-header center">Ações</th>
               </tr>
            </thead>
            <tbody class="table-body">
               @forelse ($users as $user)
                  <tr class="table-row">
                     <td class="table-cell">{{ $user->id }}</td>   
                     <td class="table-cell">{{ $user->name }}</td>   
                     <td class="table-cell">{{ $user->email }}</td>   
                     <td class="table-actions">
                        <a href="{{ route('users.show', ['user' => $user]) }}" class="btn-view-1">Visualizar</a>   
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn-warning">Editar</a>   
                        
                        <form 
                           id="delete-form-{{ $user->id }}"
                           action="{{ route('users.destroy', ['user' => $user->id]) }}" 
                           method="POST"
                        >
                           @method('delete')
                           @csrf
                              
                           <input type="button" value="Excluir" class="btn-error" onclick="confimDelete({{ $user->id }})">
                        </form>
                     </td>   
                  </tr>  
               @empty
                  <div class="alert-error">Nenhum usuário encontrado!</div>  
               @endforelse
            </tbody>
         </table>
      </div>
      <div class="pagination">
         {{ $users->links() }}
      </div>
   </div>
@endsection