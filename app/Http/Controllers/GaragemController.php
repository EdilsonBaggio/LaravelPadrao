<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\ListarGaragem;
use App\Models\Garagem;

class GaragemController extends Controller
{
    public function lista()
    {
        // Recuperar todos os registros da tabela "Lista" onde o campo "deleted_at" é nulo
        $registros = Lista::whereNull('deleted_at')->get(); 

        return view('cadastro-garagem', compact('registros'));
    }

    public function garagem(Request $request)//Cria uma função garagem
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'qtd_vagas' => 'required|string|max:255',
            'usuario_id' => 'required|string|max:255',
        ]);

        // Criar um novo veiculo com os dados validados
        $garagem = new Garagem();
        $garagem->nome = $validatedData['nome'];
        $garagem->qtd_vagas = $validatedData['qtd_vagas'];
        $garagem->usuario_id = $validatedData['usuario_id'];
        $garagem->save();

        // Redirecionar após salvar
        return redirect()->back()->with('success', 'Garagem cadastrada com sucesso!');
    }

    public function atualizar(Request $request, $id)//Cria uma função atualizar
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'qtd_vagas' => 'required|string|max:255',
            'usuario_id' => 'required|string|max:255',
        ]);

        try {
            // Encontrar a garagem pelo ID
            $garagem = Garagem::findOrFail($id);
        
            // Atualizar os dados da garagem
            $garagem->nome = $validatedData['nome'];
            $garagem->qtd_vagas = $validatedData['qtd_vagas'];
            $garagem->usuario_id = $validatedData['usuario_id'];
            $garagem->save();

            // Redirecionar após salvar
            return redirect()->route('listar')->with('success', 'Garagem atualizada com sucesso!');
        } catch (\Exception $e) {
            // Se ocorrer algum erro, redirecione de volta com uma mensagem de erro
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar a garagem.');
        }
    }

    public function editar($id)
    {
        // Encontrar a garagem pelo ID
        $garagem = Garagem::findOrFail($id);
                              
        // Aqui você pode retornar a visualização de edição com os dados da garagem, ao clicar no botão editar ele irá pegar os dados da garagem e trazer todos na pág de edição
        return view('editar-garagem', compact('garagem'));
     
     
    }

}