<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Mail\userPdfMail;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function index(Request $request) 
    {
        $users = User::
                    when($request->filled('name'), fn($query) => 
                        $query->whereLike('name', '%' . $request->name . '%')
                    )
                  ->when($request->filled('email'), fn($query) => 
                        $query->whereLike('email', '%' . $request->email . '%')
                    )
                  ->orderByDesc('id')
                  ->paginate(env('PAGINATE'))
                  ->withQueryString();

        // $users = User::orderByDesc('id')->paginate(6);

        return view('users.index', [
            'users' => $users, 
            'name' => $request->name, 
            'email' => $request->email
        ]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function create() 
    {
        return view('users.create');
    }

    public function store(UserRequest $request) 
    {
        // dd($request);
        try
        {           
            $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $request->password
                    ]);

            return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Usuário cadastrado com sucesso!');
        } 
        catch(Exception $e) 
        {
            return back()->withInput()->with('error', 'Erro a cadastrar usuário!');
        }
    }

    public function edit(User $user) 
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        try 
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            $alertMode = env('ALERT_MODE', '');
            if ($alertMode === 'padrao')
                return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Usuário editado com sucesso!');
            else
                return redirect()->route('users.show', ['user' => $user->id])->with('success_sweetAlert', 'Usuário editado com sucesso!');
         
            
        } catch (Exception $e) 
        {
            return back()->withInput()->with('error', 'Erro a editar usuário!');
        }
        
    }

    public function editPassword(User $user) 
    {
        return view('users.editPassword', ['user' => $user]);
    }

    public function updatePassword(UserRequest $request, User $user)
    {
        // $request->validate(
        //     [
        //         'password' => 'required|min:6'
        //     ],
        //     [
        //         'password.required' => 'O campo senha é obrigatório.',
        //         'password.min' => 'A senha deve ter pelo menos :min caracteres.'
        //     ]
        // );
        
        try
        {
            $user->update(
                [
                    'password' => $request->password,
                ]
            );

            return redirect()->route('users.show', ['user' => $user])->with('success', 'Senha alterada com sucesso!');

        }catch(Exception $e)
        {
            return back()->withInput()->with('error', 'Erro ao atualizar a senha!');
        }
    }

    public function destroy(User $user)
    {
        try
        {
            $user->delete();
            
            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
            // return back()->withInput()->with('success', 'Usuário excluído com sucesso!');

        }catch(Exception $e)
        {
            return redirect()->route('users.index')->with('error', 'Usuário não excluído!');
            // return back()->withInput()->with('error', 'Usuário não excluído!');
        }
    }

    public function pdfUser(User $user)
    {
        try
        {
            $pdf =  Pdf::loadView('users.pdfUser', ['user' => $user])->setPaper('a4', 'portrait');
            
            /*Baixar o arquivo .PDF*/
            // return $pdf->download('userView.pdf');

            $pdfPath = storage_path("app/public/view_user_{$user->id}.pdf");
            $pdf->save($pdfPath);

            Mail::to($user->email)->send(new userPdfMail($pdfPath, $user));

            if (file_exists($pdfPath))
            {
                unlink($pdfPath);
            }

            return redirect()->route('users.show', ['user' => $user->id])->with('success_sweetAlert', 'E-Mail enviado com sucesso!');
        
        }catch(Exception $e)
        {
            return redirect()->route('users.show', ['user' => $user->id])->with('error', 'Email não enviado!');
        }
    }
}
