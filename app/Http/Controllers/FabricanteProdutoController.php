<?php

namespace App\Http\Controllers;

use App\Exceptions\Empresa\EmpresaException;
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

  public function index(Request $request): \Inertia\Response|\Inertia\ResponseFactory
  {
    return inertia('Estoque/Fabricante/FabricanteListagemView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'fabricantes' => $this->fabricanteProdutoService->listagemFabricantePorEmpresa($request->route('cnpj'))
    ]);
  }

  public function cadastro() {
    return inertia('Estoque/Fabricante/FabricanteCadastroView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      $this->fabricanteProdutoService->cadastrarFabricantePorEmpresa([
        'cnpj' => $request->route('cnpj'),
        'fabricante_produto_nome' => $request->get('fabricante_produto_nome')
      ]);
      return redirect($request->route('cnpj') . '/estoque/fabricante/listagem')->with([
        'bfm' => [
          'tipo' => 'sucesso',
          'titulo' => 'Cadastro de Fabricante',
          'notificacao' => 'Fabricante cadastrado com sucesso'
        ]
      ]);
    } catch (EmpresaException $ee) {
      return redirect($request->route('cnpj') . '/estoque/fabricante/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro na empresa',
          'notificacao' => $ee->getMessage()
        ]
      ]);
    }
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
