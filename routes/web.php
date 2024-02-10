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

Route::get('/login', [\App\Http\Controllers\Autenticacao\LoginController::class, 'index'])->name('login');
Route::get('/cadastro', [\App\Http\Controllers\Autenticacao\CadastroController::class, 'index'])->name('cadastro');
Route::post('/login/usuario', [\App\Http\Controllers\Autenticacao\LoginController::class, 'store'])->name('login.usuario');
Route::prefix('cliente')->group(function () {
    Route::post('cadastro', [\App\Http\Controllers\Cliente\ClienteController::class, 'store'])->name('cliente.cadastro');
});
Route::prefix('empresa')->group(function () {
    Route::post('cadastro', [\App\Http\Controllers\Empresa\EmpresaController::class, 'store'])->name('empresa.cadastro');
});
