<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PessoaController;
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

Route::get('/listar-usuario', function () {
    return view('listar-usuario');
})->middleware('auth:pessoas')->name('listar');

Route::post('/send', [ContatoController::class, 'send'])->name('contato.send');
Route::post('/pessoas', [PessoaController::class, 'pessoas'])->name('pessoas');

// Rota para exibir o formulário de login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Rota para processar o login
Route::post('/', [AuthController::class, 'login'])->name('login.post');

// Rota para logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');