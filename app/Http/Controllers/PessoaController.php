<?php

namespace App\Http\Controllers; //Criando um Controller(cria as funções, o que irá fazer no banco de dados)

use App\Models\Pessoas; // Importe o modelo Pessoa
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function pessoas(Request $request) //Cria uma função para a tabela pessoas que que está no banco de dados
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',//Valida a coluna name no banco de dados e passa os parametros como o seu tipo(string)
            'email' => 'required|string|email|max:255|unique:pessoas',// unique significa que o valor do campo email é unico na tabela pessoas no bamco de dados 
            'telefone' => 'required|string|max:20',//Valida a coluna telefone no banco de dados e passa os parametros como o seu tipo(string)
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:14|unique:pessoas', // Alterado para max:14 para CPF de tamanho padrão
            'password' => 'required|string',
        ]);
 
        // Criar um novo usuário com os dados validados, se a validação dos campos for concluida com sucesso ele pegara os dados cadastrados e salvará no banco de dados
        $user = new Pessoas();//Cria uma nova instância para a classe pessoas no banco
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];//Atribui o valor preenchido do campo email 
        $user->telefone = $validatedData['telefone'];;//Atribui o valor preenchido do campo telefone
        $user->data_nascimento = $validatedData['data_nascimento'];
        $user->cpf = $validatedData['cpf'];
        $user->password = bcrypt($validatedData['password']);
        $user->save();//representa uma nova entrada no banco de dados
 
        // Redirecionar após salvar,após salvar ele retorna uma mensagem de sucesso.
        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function atualizar(Request $request, $id){//Cria uma função atualizar
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',//Valida a coluna name no banco de dados e passa os parametros que doram digitados pelo usuário
            'email' => 'required|string|email|max:255|unique:pessoas,email,'.$id,
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:14|unique:pessoas,cpf,'.$id, // Alterado para max:14 para CPF de tamanho padrão
            'password' => 'nullable|string', // O campo password é opcional ao editar
        ]);
    
        try {//try é usado para envolver um código onde podem ocorrer exceçõespermite que você lide com essas exceções de maneira organizada e controlada. Se uma exceção ocorrer dentro do bloco  procurará um bloco catch correspondente para tratar essa exceção.
            
            $user = Pessoas::findOrFail($id);// Encontra no banco de dados na tabela pessoas o usuário pelo ID
        
            // Atualizar os dados do usuário
            $user->name = $validatedData['name'];//Se a validação der certo então atribui o valor preenchido do campo name pelo usuário
            $user->email = $validatedData['email'];//Se a validação der certo então atribui o valor preenchido do campo email pelo usuário
            $user->telefone = $validatedData['telefone'];
            $user->data_nascimento = $validatedData['data_nascimento'];
            $user->cpf = $validatedData['cpf'];
            
            // Se a senha foi fornecida, atualize-a
            if(isset($validatedData['password'])){ //verifica se a senha está presente nos dados validados se estiver o if sera executado
                $user->password = bcrypt($validatedData['password']);// A senha fornecida sera validada e criptografada(bcrypt)e então atribuida ao password
            }
        
            $user->save();//Salvar alterações no banco de dados
        
            // Redirecionar após salvar para a página listar
            return redirect()->route('listar')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            // Se ocorrer algum erro, redirecione de volta para a pagina anterior com uma mensagem de erro
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o usuário.');
        }
    }
    
    public function usuario($id){ //Defini uma função usuario que espera receber um parametro id 
       
        $user = Pessoas::findOrFail($id);// Encontra o usuário pelo ID da tabela pessoas do banco de dados (findOrFail)
        
        // Aqui retorna a visualização de edição com os dados do usuário
        return view('editar', compact('user')); //Pega os dados da pessoa que está no user e trás para a tela de editar
    }

    // public function excluir($id){
    //     // Verifica se o usuário existe
    //     $user = Pessoas::find($id);
        
    //     if($user){
    //         // Se o usuário existe, exclui
    //         $user->delete();
    //         return redirect()->route('listar');
    //     } else {
    //         // Se o usuário não existe, retorna uma mensagem de erro
    //         return "Usuário não encontrado.";
    //     }
    // }

}
