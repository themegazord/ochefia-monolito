<?php

namespace App\Http\Controllers;

use App\Models\GrupoProduto;
use App\Services\Estoque\Grupo\GrupoProdutoService;
use App\Utils\States\Navbar\LinksSistema;
use Illuminate\Http\Request;

class GrupoProdutoController extends Controller
{
  public function __construct(
    private readonly GrupoProdutoService $grupoProdutoService,
    private readonly LinksSistema $links
  )
  {}

  public function index(string $cnpj)
  {
    return inertia('Estoque/Grupo/GrupoListagemView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'grupos' => $this->grupoProdutoService->listagemGrupoPorEmpresa($cnpj)
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
