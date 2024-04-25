<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\VeiculosController;
use App\Http\Controllers\ListarVeiculosController;
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

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');

Route::get('/cadastro_veiculo', function () {
    return view('cadastro_veiculo');
})->name('cadastro_veiculo');

Route::get('/listar-usuario', [ListaController::class, 'lista'])
    ->middleware('auth:pessoas')
    ->name('listar');

Route::get('/editar/{id}', [PessoaController::class, 'usuario']) // Adicionando {id} como parâmetro na rota
    ->middleware('auth:pessoas')
    ->name('usuario');

Route::get('/cadastro-veiculo', [VeiculosController::class, 'lista'])
    ->middleware('auth:pessoas')
    ->name('cadastro-veiculo');

Route::get('/listar-veiculos', [ListarVeiculosController::class, 'lista'])
    ->middleware('auth:pessoas')
    ->name('listar-veiculos');

Route::post('/send', [ContatoController::class, 'send'])->name('contato.send');
Route::post('/pessoas', [PessoaController::class, 'pessoas'])->name('pessoas');
Route::post('/veiculos', [VeiculosController::class, 'veiculos'])->name('veiculos');


// Rota para exibir o formulário de login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Rota para processar o login
Route::post('/', [AuthController::class, 'login'])->name('login.post');

// Rota para logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
