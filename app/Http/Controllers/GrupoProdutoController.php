<?php

namespace App\Http\Controllers;

use App\Enum\Estoque\Grupo\TipoGrupoEnum;
use App\Exceptions\Empresa\EmpresaException;
use App\Models\GrupoProduto;
use App\Services\Estoque\Grupo\GrupoProdutoService;
use App\Utils\States\Navbar\LinksSistema;
use Illuminate\Http\Request;

class GrupoProdutoController extends Controller
{
  public function __construct(
    private readonly GrupoProdutoService $grupoProdutoService,
    private readonly LinksSistema $links,
  )
  {}

  public function index(string $cnpj): \Inertia\Response|\Inertia\ResponseFactory
  {
    return inertia('Estoque/Grupo/GrupoListagemView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'grupos' => $this->grupoProdutoService->listagemGrupoPorEmpresa($cnpj)
    ]);
  }

  public function cadastro(): \Inertia\Response|\Inertia\ResponseFactory
  {
    return inertia('Estoque/Grupo/GrupoCadastroView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'tiposGrupo' => TipoGrupoEnum::toArray()
    ]);
  }

  public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    try {
      $this->grupoProdutoService->cadastroGrupoPorEmpresa($request->route('cnpj'), $request->toArray());
      return redirect($request->route('cnpj') . '/estoque/grupo/listagem')->with([
        'bfm' => [
          'tipo' => 'sucesso',
          'titulo' => 'Cadastro de grupo',
          'notificacao' => 'Grupo cadastrado com sucesso'
        ]
      ]);
    } catch (EmpresaException $e) {
      return redirect($request->route('cnpj') . '/estoque/grupo/listagem')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro na empresa',
          'notificacao' => $e->getMessage()
        ]
      ]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(GrupoProduto $grupoProduto)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, GrupoProduto $grupoProduto)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(GrupoProduto $grupoProduto)
  {
    //
  }
}
