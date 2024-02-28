<?php

namespace App\Http\Controllers\Estoque\Produto;

use App\Http\Controllers\Controller;
use App\Services\Estoque\Produto\ProdutoService;
use App\Utils\States\Navbar\LinksSistema;
use Illuminate\Http\Request;
use Termwind\Components\Li;

class ProdutoController extends Controller
{
  public function __construct(
    private readonly ProdutoService $produtoService,
    private readonly LinksSistema $links
  )
  {

  }
  /**
   * Display a listing of the resource.
   */
  public function index(string $cnpj): \Inertia\Response|\Inertia\ResponseFactory
  {
    $this->produtoService->listagemProdutoPorEmpresa($cnpj);
    return inertia('Estoque/Produto/ProdutoListagemView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'produtos' => $this->produtoService->listagemProdutoPorEmpresa($cnpj)
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
  public function show(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
