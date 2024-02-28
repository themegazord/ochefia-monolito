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
      Route::get('listagem', [\App\Http\Controllers\Estoque\Fabricante\FabricanteProdutoController::class, 'index'])->name('fabricante.listagem');
      Route::get('cadastro', [\App\Http\Controllers\Estoque\Fabricante\FabricanteProdutoController::class, 'cadastro'])->name('fabricante.form_cadastro');
      Route::post('cadastrar', [\App\Http\Controllers\Estoque\Fabricante\FabricanteProdutoController::class, 'store'])->name('fabricante.store');
      Route::get('edicao/{fabricante_produto_id}', [\App\Http\Controllers\Estoque\Fabricante\FabricanteProdutoController::class, 'show'])->name('fabricante.show');
      Route::put('editar/{fabricante_produto_id}', [\App\Http\Controllers\Estoque\Fabricante\FabricanteProdutoController::class, 'update'])->name('fabricante.update');
      Route::delete('deletar/{fabricante_produto_id}', [\App\Http\Controllers\Estoque\Fabricante\FabricanteProdutoController::class, 'destroy'])->name('fabricante.destroy');
    });
    Route::prefix('grupo')->group(function () {
      Route::get('listagem', [\App\Http\Controllers\Estoque\Grupo\GrupoProdutoController::class, 'index'])->name('grupo.listagem');
      Route::get('cadastro', [\App\Http\Controllers\Estoque\Grupo\GrupoProdutoController::class, 'cadastro'])->name('grupo.form_cadastro');
      Route::post('cadastrar', [\App\Http\Controllers\Estoque\Grupo\GrupoProdutoController::class, 'store'])->name('grupo.store');
      Route::get('edicao/{grupo_produto_id}', [\App\Http\Controllers\Estoque\Grupo\GrupoProdutoController::class, 'show'])->name('grupo.show');
      Route::put('editar/{grupo_produto_id}', [\App\Http\Controllers\Estoque\Grupo\GrupoProdutoController::class, 'update'])->name('grupo.update');
      Route::delete('deletar/{grupo_produto_id}', [\App\Http\Controllers\Estoque\Grupo\GrupoProdutoController::class, 'destroy'])->name('grupo.destroy');
    });
    Route::prefix('subgrupo')->group(function () {
      Route::get('listagem', [\App\Http\Controllers\Estoque\SubGrupo\SubGrupoController::class, 'index'])->name('subgrupo.listagem');
      Route::get('cadastro', [\App\Http\Controllers\Estoque\SubGrupo\SubGrupoController::class, 'cadastro'])->name('subgrupo.form_cadastro');
      Route::post('cadastrar', [\App\Http\Controllers\Estoque\SubGrupo\SubGrupoController::class, 'store'])->name('subgrupo.store');
      Route::get('edicao/{subgrupo_produto_id}', [\App\Http\Controllers\Estoque\SubGrupo\SubGrupoController::class, 'show'])->name('subgrupo.show');
      Route::put('editar/{subgrupo_produto_id}', [\App\Http\Controllers\Estoque\SubGrupo\SubGrupoController::class, 'update'])->name('subgrupo.update');
      Route::delete('deletar/{subgrupo_produto_id}', [\App\Http\Controllers\Estoque\SubGrupo\SubGrupoController::class, 'destroy'])->name('subgrupo.destroy');
    });
    Route::prefix('unidade')->group(function () {
      Route::get('listagem', [\App\Http\Controllers\Estoque\Unidade\UnidadeProdutoController::class, 'index'])->name('unidade.listagem');
      Route::get('cadastro', [\App\Http\Controllers\Estoque\Unidade\UnidadeProdutoController::class, 'cadastro'])->name('unidade.form_cadastro');
      Route::post('cadastrar', [\App\Http\Controllers\Estoque\Unidade\UnidadeProdutoController::class, 'store'])->name('unidade.store');
      Route::get('edicao/{unidade_produto_id}', [\App\Http\Controllers\Estoque\Unidade\UnidadeProdutoController::class, 'show'])->name('unidade.show');
      Route::put('editar/{unidade_produto_id}', [\App\Http\Controllers\Estoque\Unidade\UnidadeProdutoController::class, 'update'])->name('unidade.update');
      Route::delete('deletar/{unidade_produto_id}', [\App\Http\Controllers\Estoque\Unidade\UnidadeProdutoController::class, 'destroy'])->name('unidade.destroy');
    });
  });
});
