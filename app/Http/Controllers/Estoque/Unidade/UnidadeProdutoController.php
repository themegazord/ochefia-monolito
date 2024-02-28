<?php

namespace App\Http\Controllers\Estoque\Unidade;

use App\Exceptions\Estoque\UnidadeProdutoException;
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

  public function cadastro(): \Inertia\Response|\Inertia\ResponseFactory
  {
    return inertia('Estoque/Unidade/UnidadeCadastroView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $this->unidadeProdutoService->cadastroUnidadeProdutoPorEmpresa($request->route('cnpj'), $request->toArray());
    return redirect($request->route('cnpj') . '/estoque/unidade/listagem')->with([
      'bfm' => [
        'tipo' => 'sucesso',
        'titulo' => 'Cadastro unidade de medida',
        'notificacao' => 'Unidade de medida cadastrada com sucesso'
      ]
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $cnpj, int $unidade_produto_id): \Illuminate\Foundation\Application|\Inertia\Response|\Illuminate\Routing\Redirector|\Inertia\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    try {
      return inertia('Estoque/Unidade/UnidadeEdicaoView', [
        'menus' => $this->links->getMenus(),
        'subMenus' => $this->links->getSubMenus(),
        'unidadeBanco' => $this->unidadeProdutoService->consultaUnidadeProdutoPorEmpresa($cnpj, $unidade_produto_id)
      ]);
    } catch (UnidadeProdutoException $upe) {
      return redirect($cnpj . '/estoque/unidade/listagem')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro na unidade de medida',
          'notificacao' => $upe->getMessage()
        ]
      ]);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $cnpj): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    try {
      $this->unidadeProdutoService->edicaoUnidadeProdutoPorEmpresa($request->toArray(), $cnpj);
      return redirect($request->route('cnpj') . '/estoque/unidade/listagem')->with([
        'bfm' => [
          'tipo' => 'sucesso',
          'titulo' => 'Edição da unidade de medida',
          'notificacao' => 'Unidade de medida editada com sucesso'
        ]
      ]);
    } catch (UnidadeProdutoException $upe) {
      return redirect($request->route('cnpj') . '/estoque/unidade/edicao/' . $request->get('unidade_produto_id'))->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro na unidade de medida',
          'notificacao' => $upe->getMessage()
        ]
      ]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $cnpj, int $unidade_produto_id)
  {
    $this->unidadeProdutoService->removeUnidadeProdutoPorEmpresa($cnpj, $unidade_produto_id);
    return redirect($cnpj . '/estoque/unidade/listagem')->with([
      'bfm' => [
        'tipo' => 'sucesso',
        'titulo' => 'Remoção da unidade de medida',
        'notificacao' => 'Unidade de medida removida com sucesso'
      ]
    ]);
  }
}
