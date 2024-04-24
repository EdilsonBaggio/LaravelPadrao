<?php

namespace App\Http\Controllers;

use App\Models\Pessoas; // Importe o modelo Pessoa
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function pessoas(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pessoas',
            'verificacao_email' => 'required|string|email|max:255|unique:pessoas',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:11|unique:pessoas', // Alterado para max:11 para CPF de tamanho padrão
            'password' => 'required|string',
        ]);
 
        // Criar um novo usuário com os dados validados
        $user = new Pessoas();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->verificacao_email = $validatedData['verificacao_email'];
        $user->telefone = $validatedData['telefone'];
        $user->data_nascimento = $validatedData['data_nascimento'];
        $user->cpf = $validatedData['cpf'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();
 
        // Redirecionar após salvar
        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function atualizar(Request $request, $id){
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pessoas,email,'.$id,
            'verificacao_email' => 'required|string|email|max:255|unique:pessoas,verificacao_email,'.$id,
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:11|unique:pessoas,cpf,'.$id, // Alterado para max:11 para CPF de tamanho padrão
            'password' => 'nullable|string', // O campo password é opcional ao editar
        ]);
    
        try {
            // Encontrar o usuário pelo ID
            $user = Pessoas::findOrFail($id);
        
            // Atualizar os dados do usuário
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->verificacao_email = $validatedData['verificacao_email'];
            $user->telefone = $validatedData['telefone'];
            $user->data_nascimento = $validatedData['data_nascimento'];
            $user->cpf = $validatedData['cpf'];
            
            // Se a senha foi fornecida, atualize-a
            if(isset($validatedData['password'])){
                $user->password = bcrypt($validatedData['password']);
            }
        
            $user->save();
        
            // Redirecionar após salvar
            return redirect()->route('listar-usuario')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            // Se ocorrer algum erro, redirecione de volta com uma mensagem de erro
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o usuário.');
        }
    }
    

    public function usuario($id){
        // Encontrar o usuário pelo ID
        $user = Pessoas::findOrFail($id);
        
        // Aqui você pode retornar a visualização de edição com os dados do usuário
        return view('editar', compact('user'));
    }

    public function excluir($id){
        // Verifica se o usuário existe
        $user = Pessoas::find($id);
        
        if($user){
            // Se o usuário existe, exclui
            $user->delete();
            return redirect()->route('listar');
        } else {
            // Se o usuário não existe, retorna uma mensagem de erro
            return "Usuário não encontrado.";
        }
    }

}
