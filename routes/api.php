<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\VeiculosController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/pesssoa/editar/{id}', [PessoaController::class, 'atualizar'])->name('atualizar');
Route::post('/veiculos/editar/{id}', [VeiculosController::class, 'atualizar'])->name('atualizar_veiculos');
Route::get('/pessoa/editar/{id}', [PessoaController::class, 'excluir'])->name('excluir_pessoa');
Route::get('/veiculos/editar/{id}', [VeiculosController::class, 'excluir'])->name('excluir_veiculo');
