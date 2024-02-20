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
Route::prefix('{cnpj}')->middleware(['auth', 'verifica.funcionario.empresa'])->group(function () {
  Route::get('/', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');
  Route::post('logout', [\App\Http\Controllers\Autenticacao\LoginController::class, 'destroy'])->name('logout');
  Route::prefix('estoque')->group(function () {
    Route::prefix('classe')->group(function () {
      Route::get('listagem', [\App\Http\Controllers\Estoque\Classe\ClasseController::class, 'index'])->name('classe.listagem');
      Route::get('cadastro', [\App\Http\Controllers\Estoque\Classe\ClasseController::class, 'cadastro'])->name('classe.form.cadastro');
      Route::post('cadastrar', [\App\Http\Controllers\Estoque\Classe\ClasseController::class, 'store'])->name('classe.store');
      Route::get('edicao/{classe_id}', [\App\Http\Controllers\Estoque\Classe\ClasseController::class, 'edicao'])->name('classe.form.edicao');
      Route::put('editar/{classe_id}', [\App\Http\Controllers\Estoque\Classe\ClasseController::class, 'update'])->name('classe.update');
      Route::delete('deletar/{classe_id}', [\App\Http\Controllers\Estoque\Classe\ClasseController::class, 'destroy'])->name('classe.destroy');
    });
    Route::prefix('fabricante')->group(function () {
      Route::get('listagem', [\App\Http\Controllers\FabricanteProdutoController::class, 'index'])->name('fabricante.listagem');
    });
  });
});
