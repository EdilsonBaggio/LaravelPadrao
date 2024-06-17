<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Veiculos;
use App\Models\Lista;
use App\Models\ListarGaragem;

class VeiculosController extends Controller
{
    public function veiculos(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'placa' => 'required|string|max:255',
            'usuario_id' => 'required|exists:pessoas,id',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'garagem_id' => 'required|exists:garagems,id',
        ]);
 
        // Criar um novo veiculo com os dados validados
        $veiculo = new Veiculos();
        $veiculo->usuario_id = $validatedData['usuario_id']; 
        $veiculo->placa = $validatedData['placa'];
        $veiculo->modelo = $validatedData['modelo'];
        $veiculo->cor = $validatedData['cor'];
        $veiculo->marca = $validatedData['marca'];
        $veiculo->garagem_id = $validatedData['garagem_id']; // Associando o veículo à garagem selecionada
        $veiculo->save();

        // Redirecionar após salvar
        return redirect()->back()->with('success', 'Veiculo cadastrado com sucesso!');
    }


    public function lista()//Criando uma função com o nome lista
    {
         // Recuperar todos os veículos com suas informações associadas
        $veiculos = Veiculos::all();
        // Recuperar todos os registros da tabela "Lista" onde o campo "deleted_at" é nulo
        $registros = Lista::whereNull('deleted_at')->get(); //Cria uma variavel chamada registros onde irá recuperar todos os registros
        $garagens = ListarGaragem::whereNull('deleted_at')->get(); //Cria uma variavel chamada garagens onde irá recuperar todas as garagens (atraves desse comando ele irá pegar todas as garagens que tem cadstrada no banco e trazer no select na pagina cadastro-veiculo)

        return view('cadastro-veiculo', compact('registros','garagens'));//Retorna para a página de cadastro-veiculo os registros e as garagens
        
    }

    public function atualizar(Request $request, $id){
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'placa' => 'required|string|max:255',
            'usuario_id' => 'required|exists:pessoas,id',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'garagem_id' => 'required|exists:garagems,id',
        ]);
    
        try {
            // Encontrar o usuário pelo ID
            $veiculo = Veiculos::findOrFail($id);
        
            // Atualizar os dados do usuário
            $veiculo->usuario_id = $validatedData['usuario_id'];
            $veiculo->placa = $validatedData['placa'];
            $veiculo->modelo = $validatedData['modelo'];
            $veiculo->cor = $validatedData['cor'];
            $veiculo->marca = $validatedData['marca'];
            $veiculo->garagem_id = $validatedData['garagem_id'];
            $veiculo->save();

            // Redirecionar após salvar
            return redirect()->route('listar')->with('success', 'Veículo atualizado com sucesso!');
        } catch (\Exception $e) {
            // Se ocorrer algum erro, redirecione de volta com uma mensagem de erro
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o Veículo.');
        }
    }

    public function veiculo($id)
    {
        // Encontrar o veículo pelo ID com informações adicionais do usuário
        $veiculo = Veiculos::leftJoin('pessoas', 'pessoas.id', '=', 'veiculos.usuario_id')
                    ->leftJoin('garagems', 'garagems.id', '=', )// LEFT JOIN com a tabela "garagem", Está pegando da tabela garagems do banco de dados o id e dizendo que é igual a garagem_id da tabela veiculos do banco de dados.
                    ->select('veiculos.*', 'pessoas.name as usuario') // Seleção do campo nome da tabela garagems
                    ->findOrFail($id);
                                        
        // Aqui você pode retornar a visualização de edição com os dados do veículo e do usuário
        return view('editar-veiculos', compact('veiculo'));
    }  
}
