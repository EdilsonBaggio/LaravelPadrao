<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;//Importando o controller de PessoaController para manipular requisições relacionadas as pessoas
use App\Http\Controllers\VeiculosController;//Importando o controller de VeiculosController para manipular requisições relacionadas a veiculos

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {//Define uma rota protegida por autenticação usando Sanctum. Quando um usuário autenticado acessa essa rota, a função de retorno é chamada.
    return $request->user();//Retorna o usuário autenticado
});

Route::post('/pesssoa/editar/{id}', [PessoaController::class, 'atualizar'])->name('atualizar');//Define uma rota do tipo post para atualizar dados da pessoa ao clicar no botão
Route::post('/veiculos/editar/{id}', [VeiculosController::class, 'atualizar'])->name('atualizar_veiculos');//Define uma rota do tipo post para atualizar_veiculos dados do veiculo serão atualizados
Route::get('/pessoa/editar/{id}', [PessoaController::class, 'excluir'])->name('excluir_pessoa');    
Route::get('/veiculos/editar/{id}', [VeiculosController::class, 'excluir'])->name('excluir_veiculo');
//GET:Usado para recuperar dados, ele aparece no link da URL,exemplo:se um usuario busca um chapeu na internet e ele quer enviar um link para um amigo, se estiver usando o metodo get vai entrar direto no chapeu que ele estava vendo.
//POST:Envia os dados para serem processados,faria a busca porem não estaria na URL