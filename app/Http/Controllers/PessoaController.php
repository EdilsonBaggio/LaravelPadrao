<?php

namespace App\Http\Controllers;

use App\Models\Pessoas; // Importe o modelo Pessoa
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function pessoas(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pessoas',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:11|unique:pessoas', // Alterado para max:11 para CPF de tamanho padrão
            'password' => 'required|string',
        ]);
 
        // Criar um novo usuário com os dados validados
        $user = new Pessoas();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->telefone = $validatedData['telefone'];
        $user->data_nascimento = $validatedData['data_nascimento'];
        $user->cpf = $validatedData['cpf'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();
 
        // Redirecionar após salvar
        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }
}
