<?php

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

Route::get('/login', [\App\Http\Controllers\Autenticacao\LoginController::class, 'login']);
Route::get('/cadastro', [\App\Http\Controllers\Autenticacao\CadastroController::class, 'index']);
Route::prefix('cliente')->group(function () {
    Route::post('cadastro', [\App\Http\Controllers\Cliente\ClienteController::class, 'store']);
});
Route::prefix('empresa')->group(function () {
    Route::post('cadastro', [\App\Http\Controllers\Empresa\EmpresaController::class, 'store']);
});
