<?php

namespace App\Http\Controllers;

use App\Exceptions\Empresa\EmpresaException;
use App\Exceptions\Estoque\FabricanteProdutoException;
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
  public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
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
  public function show(Request $request, string $cnpj, int $fabricante_produto_id)
  {
    try {
      $fabricante = $this->fabricanteProdutoService->consultaFabricantePorEmpresa(
        [
          'cnpj' => $cnpj,
          'fabricante_produto_id' => $fabricante_produto_id
        ]
      );
      return inertia('Estoque/Fabricante/FabricanteEdicaoView', [
        'menus' => $this->links->getMenus(),
        'subMenus' => $this->links->getSubMenus(),
        'fabricanteBanco' => $fabricante
      ]);
    } catch (EmpresaException $ee) {
      return redirect($request->route('cnpj') . '/estoque/fabricante/listagem')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro na empresa',
          'notificacao' => $ee->getMessage()
        ]
      ]);
    } catch (FabricanteProdutoException $fpe) {
      return redirect($request->route('cnpj') . '/estoque/fabricante/listagem')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro no fabricante',
          'notificacao' => $fpe->getMessage()
        ]
      ]);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    $this->fabricanteProdutoService->editaFabricantePorEmpresa($request->toArray());
    return redirect($request->route('cnpj') . '/estoque/fabricante/listagem')->with(
      'bfm',
      [
        'tipo' => 'sucesso',
        'titulo' => 'Atualicação de fabricante',
        'notificacao' => 'Fabricante atualizado com sucesso'
      ]
    );
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(FabricanteProduto $fabricanteProduto)
  {
    //
  }
}
