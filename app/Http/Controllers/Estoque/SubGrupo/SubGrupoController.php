<?php

namespace App\Http\Controllers\Estoque\SubGrupo;

use App\Exceptions\Estoque\SubGrupoProdutoException;
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
    return inertia('Estoque/SubGrupo/SubGrupoListagemView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'subgrupos' => $this->subGrupoProdutoService->listagemSubGrupoPorEmpresa($cnpj)
    ]);
  }

  public function cadastro(): \Inertia\Response|\Inertia\ResponseFactory
  {
    return inertia('Estoque/SubGrupo/SubGrupoCadastroView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
    ]);
  }


  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    $this->subGrupoProdutoService->cadastroSubGrupoPorEmpresa($request->toArray(), $request->route('cnpj'));
    return redirect($request->route('cnpj') . '/estoque/subgrupo/listagem')->with([
      'bfm' => [
        'tipo' => 'sucesso',
        'titulo' => 'Cadastro de subgrupo',
        'notificacao' => 'Cadastro de subgrupo concluido com sucesso.'
      ]
    ]);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $cnpj, int $subgrupo_produto_id): \Illuminate\Foundation\Application|\Inertia\Response|\Illuminate\Routing\Redirector|\Inertia\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    try {
      return inertia('Estoque/SubGrupo/SubGrupoEdicaoView', [
        'menus' => $this->links->getMenus(),
        'subMenus' => $this->links->getSubMenus(),
        'subgrupoBanco' => $this->subGrupoProdutoService->consultaSubGrupoPorEmpresa($cnpj, $subgrupo_produto_id)
      ]);
    } catch (SubGrupoProdutoException $sgpe) {
      return redirect($cnpj . '/estoque/subgrupo/listagem')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro do subgrupo',
          'notificacao' => $sgpe->getMessage()
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
      $this->subGrupoProdutoService->editaSubGrupoPorEmpresa($request->toArray(), $cnpj);
      return redirect($cnpj . '/estoque/subgrupo/listagem')->with([
        'bfm' => [
          'tipo' => 'sucesso',
          'titulo' => 'Edição do subgrupo',
          'notificacao' => 'Subgrupo editado com sucesso'
        ]
      ]);
    } catch (SubGrupoProdutoException $sgpe) {
      return redirect($cnpj . '/estoque/subgrupo/edicao/' . $request->get('subgrupo_produto_id'))->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro do subgrupo',
          'notificacao' => $sgpe->getMessage()
        ]
      ]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $cnpj, int $subgrupo_produto_id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    $this->subGrupoProdutoService->removeSubGrupoPorEmpresa($cnpj, $subgrupo_produto_id);
    return redirect($cnpj . '/estoque/subgrupo/listagem')->with([
      'bfm' => [
        'tipo' => 'sucesso',
        'titulo' => 'Remocao do subgrupo',
        'notificacao' => 'Subgrupo removido com sucesso'
      ]
    ]);
  }
}
