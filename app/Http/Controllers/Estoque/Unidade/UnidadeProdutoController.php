<?php

namespace App\Http\Controllers\Estoque\Unidade;

use App\Http\Controllers\Controller;
use App\Models\Estoque\Unidade\UnidadeProduto;
use App\Services\Estoque\Unidade\UnidadeProdutoService;
use App\Utils\States\Navbar\LinksSistema;
use Illuminate\Http\Request;

class UnidadeProdutoController extends Controller
{
  public function __construct(
    private readonly UnidadeProdutoService $unidadeProdutoService,
    private readonly LinksSistema $links
  )
  {

  }
  /**
   * Display a listing of the resource.
   */
  public function index(string $cnpj): \Inertia\Response|\Inertia\ResponseFactory
  {
    return inertia('Estoque/Unidade/UnidadeListagemView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'unidades' => $this->unidadeProdutoService->listagemUnidadeProdutoPorEmpresa($cnpj)
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
  public function show(UnidadeProduto $unidade)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, UnidadeProduto $unidade)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(UnidadeProduto $unidade)
  {
    //
  }
}
