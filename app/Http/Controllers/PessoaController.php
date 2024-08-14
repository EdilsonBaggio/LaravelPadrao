<?php

namespace App\Http\Controllers;

use App\Models\Pessoas;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function pessoas(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pessoas',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:14|unique:pessoas',
            'password' => 'required|string',
        ]);

        $user = new Pessoas();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->telefone = $validatedData['telefone'];
        $user->data_nascimento = $validatedData['data_nascimento'];
        $user->cpf = $validatedData['cpf'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();
        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function atualizar(Request $request, $id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pessoas,email,'.$id,
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:14|unique:pessoas,cpf,'.$id,
            'password' => 'nullable|string', 
        ]);
    
        try {
            
            $user = Pessoas::findOrFail($id);
        
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->telefone = $validatedData['telefone'];
            $user->data_nascimento = $validatedData['data_nascimento'];
            $user->cpf = $validatedData['cpf'];
        
            if(isset($validatedData['password'])){
                $user->password = bcrypt($validatedData['password']);
            }
            $user->save();
        
            return redirect()->route('listar')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o usuário.');
        }
    }
    
    public function usuario($id){ 
        $user = Pessoas::findOrFail($id);
        return view('editar', compact('user'));
    }
}
