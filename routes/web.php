<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\VeiculosController;
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

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/esqueci', function () {
    return view('auth.esqueci');
})->name('esqueci');

Route::middleware('auth:pessoas')->group(function(){
    Route::get('/cadastro-veiculo', function () {
        return view('cadastro-veiculo');
    })->name('cadastro-veiculo');

    Route::get('/cadastro-garagem', function () {
        return view('cadastro-garagem');
    })->name('cadastro-garagem');

    Route::get('/garagens', function () {
        return view('garagens');
    })->name('garagens');

    Route::get('/listar-usuario', [ListaController::class, 'lista'])->name('listar');
    Route::get('/usuarios/editar/{id}', [PessoaController::class, 'usuario'])->name('usuario');
    Route::get('/veiculos/{id}/editar', [VeiculosController::class, 'veiculo'])->name('veiculo.editar');
    Route::get('/cadastro-garagem', [GaragemController::class, 'lista'])->name('cadastro-garagem');
    Route::get('/cadastro-veiculo', [VeiculosController::class, 'lista'])->name('cadastro-veiculo');
    Route::get('/listar-veiculos', [ListarVeiculosController::class, 'lista'])->name('listar-veiculos');
    Route::get('/listar-garagem', [ListarGaragemController::class, 'lista'])->name('listar-garagem');
    Route::get('/garagem/{id}/editar', [GaragemController::class, 'editar'])->name('garagem.editar');
});

Route::post('/send', [ContatoController::class, 'send'])->name('contato.send');
Route::post('/pessoas', [PessoaController::class, 'pessoas'])->name('pessoas');
Route::post('/veiculos', [VeiculosController::class, 'veiculos'])->name('veiculos');
Route::post('/garagem', [GaragemController::class, 'garagem'])->name('garagem');
Route::post('/garagem/atualizar/{id}', [GaragemController::class, 'atualizar'])->name('atualizar_garagem');
Route::get('/whatsapp', [OneCodeController::class, 'enviarOneCode'])->name('contato.whatsapp');


Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Rota para processar o login
Route::post('/', [AuthController::class, 'login'])->name('login.post');
Route::post('/redefinir', [AuthController::class, 'esqueci'])->name('redefinir');

// Rota para logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/redefinir/{token}', function ($token) {
    return view('auth.resetar', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');