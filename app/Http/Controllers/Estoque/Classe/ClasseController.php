<?php

namespace App\Http\Controllers\Estoque\Classe;

use App\Exceptions\Empresa\EmpresaException;
use App\Http\Controllers\Controller;
use App\Services\Estoque\Classe\ClasseProdutoService;
use App\Utils\States\Navbar\LinksSistema;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ClasseController extends Controller
{
  public function __construct(
    private readonly LinksSistema         $links,
    private readonly ClasseProdutoService $classeProdutoService
  )
  {
  }

  /**
   * @throws EmpresaException
   */
  public function index(Request $request): Response|ResponseFactory|RedirectResponse
  {
    return inertia('Estoque/Classe/ClasseListagemView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'classes' => $this->classeProdutoService->listagemClasseProdutos($request->route('cnpj')),
    ]);
  }

  public function cadastro(): Response|ResponseFactory
  {
    return inertia('Estoque/Classe/ClasseCadastroView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
    ]);
  }

  public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
  {
    try {
      $this->classeProdutoService->cadastroClasseProdutos([
        'classe_produto_nome' => $request->get('classe_produto_nome'),
        'cnpj' => $request->route('cnpj')
      ]);
      return redirect($request->route('cnpj') . '/estoque/classe/listagem')->with(
        'bfm',
        [
          'tipo' => 'sucesso',
          'titulo' => 'Cadastro de classe',
          'notificacao' => 'Classe cadastrada com sucesso'
        ]
      );
    } catch (EmpresaException $ee) {
      return redirect($request->route('cnpj') . '/estoque/classe/cadastro')->with(
        'bfm',
        [
          'tipo' => 'erro',
          'titulo' => 'Erro na empresa',
          'notificacao' => $ee->getMessage()
        ]
      );
    }
  }

  public function edicao(string $cnpj, int $classe_id): Response|ResponseFactory
  {
    return inertia('Estoque/Classe/ClasseEditarView', [
      'menus' => $this->links->getMenus(),
      'subMenus' => $this->links->getSubMenus(),
      'classeBanco' => $this->classeProdutoService->consultaClasseProdutoPorId($classe_id)->getAttributes()
    ]);
  }

  public function update(Request $request) {
    try {
      $this->classeProdutoService->atualizaClasseProdutoPorEmpresa($request->toArray());
      return redirect($request->route('cnpj') . '/estoque/classe/listagem')->with(
        'bfm',
        [
          'tipo' => 'sucesso',
          'titulo' => 'Atualicação de classe',
          'notificacao' => 'Classe atualizada com sucesso'
        ]
      );
    } catch (\Exception $e) {
      return redirect($request->route('cnpj') . '/estoque/classe/edicao/' . $request->toArray()['classe_produto_id'])->with(
        'bfm',
        [
          'tipo' => 'erro',
          'titulo' => 'Erro na empresa',
          'notificacao' => $e->getMessage()
        ]);
    }
  }
}
