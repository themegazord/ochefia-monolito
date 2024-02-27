<?php

namespace App\Http\Controllers\Estoque\SubGrupo;

use App\Http\Controllers\Controller;
use App\Models\Estoque\SubGrupo\SubGrupoProduto;
use App\Services\Estoque\SubGrupo\SubGrupoProdutoService;
use App\Utils\States\Navbar\LinksSistema;
use Illuminate\Http\Request;

class SubGrupoController extends Controller
{
  public function __construct(
    private readonly SubGrupoProdutoService $subGrupoProdutoService,
    private readonly LinksSistema $links
  )
  {}

  /**
   * Display a listing of the resource.
   */
  public function index(string $cnpj): \Inertia\Response|\Inertia\ResponseFactory
  {
    return inertia('Estoque/SubGrupo/SubGrupoListagemVue', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'subgrupos' => $this->subGrupoProdutoService->listagemSubGrupoPorEmpresa($cnpj)
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(SubGrupoProduto $subGrupo)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, SubGrupoProduto $subGrupo)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(SubGrupoProduto $subGrupo)
  {
    //
  }
}
