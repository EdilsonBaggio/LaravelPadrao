<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PessoaController;//Importando o controller de PessoaController
use App\Http\Controllers\ListaController;//Importando o controller de ListaController
use App\Http\Controllers\VeiculosController;//Importando o controller de VeiculosController
use App\Http\Controllers\ListarVeiculosController;
use App\Http\Controllers\GaragemController;
use App\Http\Controllers\ListarGaragemController;
use App\Http\Controllers\OneCodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () { //Rota do tipo get que ao ser acessada entra na página com o nome de home 
    return view('home');
})->name('home');

Route::get('/cadastro', function () {//Rota do tipo get que ao ser acessada entra na página com o nome de cadastro
    return view('cadastro');
})->name('cadastro');

Route::get('/cadastro-veiculo', function () { //Rota do tipo get que ao ser acessada entra na página com o nome de cadastro-veiculo
    return view('cadastro-veiculo');
})->name('cadastro-veiculo');

Route::get('/cadastro-garagem', function () { //Rota do tipo get que ao ser acessada entra na página com o nome de cadastro-veiculo
    return view('cadastro-garagem');
})->name('cadastro-garagem');

//Rota com Controladores:
Route::get('/listar-usuario', [ListaController::class, 'lista'])//Defini a rota como GET para o URL listar-usuario
    ->middleware('auth:pessoas')//middleware:significa que o usuario só conseguira acessar essa rota se estiver logado (autenticado) na tabela pessoas do banco de dados.
    ->name('listar');//Rota sendo nomeada como listar

Route::get('/usuarios/editar/{id}', [PessoaController::class, 'usuario']) //Defini a rota como GET para o URL /usuarios/editar/{id}
    ->middleware('auth:pessoas')//middleware:significa que o usuario só conseguira acessar essa rota se estiver logado (autenticado) na tabela pessoas do banco de dados.
    ->name('usuario');//Rota sendo nomeada como usuario

Route::get('/veiculos/editar/{id}', [VeiculosController::class, 'veiculo']) //Defini a rota como GET para o URL veiculos/editar/{id}
    ->middleware('auth:pessoas')//middleware:significa que o usuario só conseguira acessar essa rota se estiver logado (autenticado) na tabela pessoas do banco de dados.
    ->name('veiculo');//Rota sendo nomeada como veiculo

Route::get('/cadastro-garagem', [GaragemController::class, 'lista'])
    ->name('cadastro-garagem');

Route::get('/cadastro-veiculo', [VeiculosController::class, 'lista'])
    ->name('cadastro-veiculo');

Route::get('/listar-veiculos', [ListarVeiculosController::class, 'lista'])
    ->middleware('auth:pessoas')
    ->name('listar-veiculos');

Route::get('/listar-garagem', [ListarGaragemController::class, 'lista'])
    ->middleware('auth:pessoas')
    ->name('listar-garagem');

 Route::get('/garagem/{id}/editar', [GaragemController::class, 'editar'])
 ->name('garagem.editar');


Route::post('/send', [ContatoController::class, 'send'])->name('contato.send');//Criando uma rota do tipo POST para o metodo send com o nome de contato.send(envio de formulário de contato)
Route::post('/pessoas', [PessoaController::class, 'pessoas'])->name('pessoas');//Criando uma rota do tipo POST para o metodo pessoas com o nome de pessoas(envio de dados de pessoa)
Route::post('/veiculos', [VeiculosController::class, 'veiculos'])->name('veiculos');//Criando uma rota do tipo POST para o metodo veiculos com o nome de veiculos(envio dados de veiculos)
Route::post('/garagem', [GaragemController::class, 'garagem'])->name('garagem');
Route::post('/garagem/atualizar/{id}', [GaragemController::class, 'atualizar'])->name('atualizar_garagem');
// Rota para enviar a mensagem ao OneCode
Route::get('/whatsapp', [OneCodeController::class, 'enviarOneCode'])->name('contato.whatsapp');

// Rota para exibir o formulário de login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');//Está criando uma rota que está chamando um controlador(AuthController) e o metodo(showLoginForm) e atribuindo um nome para essa rota como:login (ESSAS INFORMAÇÕES ESTÁ SENDO PUXADA DA PÁGINA AUTHCONTROLLER)

// Rota para processar o login
Route::post('/', [AuthController::class, 'login'])->name('login.post');//Está criando uma rota que está chamando um controlador(AuthController) e o metodo(login) e atribuindo um nome para essa rota como:login.post

// Rota para logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');//Defini uma rota post para /logout e está chamando um controlador(AuthController) e o metodo(logout) e atribuindo um nome para essa rota como:logout