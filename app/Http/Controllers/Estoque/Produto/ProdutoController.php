<?php

namespace App\Http\Controllers\Estoque\Produto;

use App\Exceptions\Estoque\ClasseProdutoException;
use App\Exceptions\Estoque\FabricanteProdutoException;
use App\Exceptions\Estoque\GrupoProdutoException;
use App\Exceptions\Estoque\ProdutoException;
use App\Exceptions\Estoque\SubGrupoProdutoException;
use App\Exceptions\Estoque\UnidadeProdutoException;
use App\Http\Controllers\Controller;
use App\Services\Estoque\Produto\ProdutoService;
use App\Utils\States\Navbar\LinksSistema;
use Illuminate\Http\Request;

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

  public function cadastro(string $cnpj): \Inertia\Response|\Inertia\ResponseFactory
  {
    return inertia('Estoque/Produto/ProdutoCadastroView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'dadosParaCadastro' => $this->produtoService->consultaNecessidadesCadastroProdutoPorEmpresa($cnpj)
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    try {
      $this->produtoService->cadastraProdutoPorEmpresa($request->toArray(), $request->route('cnpj'));
      return redirect($request->route('cnpj') . '/estoque/produto/listagem')->with([
        'bfm' => [
          'tipo' => 'sucesso',
          'titulo' => 'Cadastro de produto',
          'notificacao' => 'Produto cadastrado com sucesso'
        ]
      ]);
    } catch (ClasseProdutoException $cpe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro na classe',
          'notificacao' => $cpe->getMessage()
        ]
      ]);
    } catch (FabricanteProdutoException $fpe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro no fabricante',
          'notificacao' => $fpe->getMessage()
        ]
      ]);
    } catch (GrupoProdutoException $gpe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro no grupo',
          'notificacao' => $gpe->getMessage()
        ]
      ]);
    } catch (SubGrupoProdutoException $sgpe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro no subgrupo',
          'notificacao' => $sgpe->getMessage()
        ]
      ]);
    } catch (UnidadeProdutoException $upe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro na unidade de medida',
          'notificacao' => $upe->getMessage()
        ]
      ]);
    }
  }

  /**
   * Display the specified resource.
   * @throws ProdutoException
   */
  public function show(string $cnpj, int $produto_id): \Illuminate\Foundation\Application|\Inertia\Response|\Illuminate\Routing\Redirector|\Inertia\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    try {
      return inertia('Estoque/Produto/ProdutoEdicaoView', [
        'menus' => $this->links->getMenus(),
        'subMenus' => $this->links->getSubMenus(),
        'dadosParaCadastro' => $this->produtoService->consultaNecessidadesCadastroProdutoPorEmpresa($cnpj),
        'produtoBanco' => $this->produtoService->consultaProdutoPorEmpresa($cnpj, $produto_id)
      ]);
    }catch (ProdutoException $pe) {
      return redirect()->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro no produto',
          'notificacao' => $pe->getMessage()
        ]
      ]);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    try {
      $this->produtoService->editaProdutoPorEmpresa($request->toArray(), $request->route('cnpj'));
      return redirect($request->route('cnpj') . '/estoque/produto/listagem')->with([
        'bfm' => [
          'tipo' => 'sucesso',
          'titulo' => 'Edição de produto',
          'notificacao' => 'Produto editado com sucesso'
        ]
      ]);
    } catch (ProdutoException $pe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro no produto',
          'notificacao' => $pe->getMessage()
        ]
      ]);
    } catch (ClasseProdutoException $cpe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro na classe',
          'notificacao' => $cpe->getMessage()
        ]
      ]);
    } catch (FabricanteProdutoException $fpe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro no fabricante',
          'notificacao' => $fpe->getMessage()
        ]
      ]);
    } catch (GrupoProdutoException $gpe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro no grupo',
          'notificacao' => $gpe->getMessage()
        ]
      ]);
    } catch (SubGrupoProdutoException $sgpe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
        'bfm' => [
          'tipo' => 'erro',
          'titulo' => 'Erro no subgrupo',
          'notificacao' => $sgpe->getMessage()
        ]
      ]);
    } catch (UnidadeProdutoException $upe) {
      return redirect($request->route('cnpj') . '/estoque/produto/cadastro')->with([
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
  public function destroy(string $id)
  {
    //
  }
}
