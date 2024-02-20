<?php

namespace App\Http\Controllers;

use App\Models\FabricanteProduto;
use App\Services\Estoque\Fabricante\FabricanteProdutoService;
use App\Utils\States\Navbar\LinksSistema;
use Illuminate\Http\Request;

class FabricanteProdutoController extends Controller
{
  public function __construct(
    private readonly LinksSistema $links,
    private readonly FabricanteProdutoService $fabricanteProdutoService
  )
  {

  }

  public function index(Request $request)
  {
    return inertia('Estoque/Fabricante/FabricanteListagemView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'fabricantes' => $this->fabricanteProdutoService->listagemFabricantePorEmpresa($request->route('cnpj'))
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
  public function show(FabricanteProduto $fabricanteProduto)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, FabricanteProduto $fabricanteProduto)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(FabricanteProduto $fabricanteProduto)
  {
    //
  }
}
