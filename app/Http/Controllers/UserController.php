<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefone' => 'required|string|max:20',
            'date' => 'required|date',
            'cpf' => 'required|string|max:14|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
 
        // Criar um novo usuário com os dados validados
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->email_verified_at = $validatedData['email_verified_at'];
        $user->telefone = $validatedData['telefone'];
        $user->data_nascimento = $validatedData['data_nascimento'];
        $user->cpf = $validatedData['cpf'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();
 
        // Redirecionar após salvar
        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }
}
