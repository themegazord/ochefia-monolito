<?php

namespace App\Http\Controllers\Estoque\Classe;

use App\Http\Controllers\Controller;
use App\Services\Estoque\Classe\ClasseProdutoService;
use App\Utils\States\Navbar\LinksSistema;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ClasseController extends Controller
{
    public function __construct(
      private readonly LinksSistema $links,
      private readonly ClasseProdutoService $classeProdutoService
    )
    {
    }

    public function index(Request $request): Response|ResponseFactory {
      return inertia('Estoque/Classe/ClasseListagemView', [
        'menus' => $this->links->getMenus(),
        'subMenus' => $this->links->getSubMenus(),
        'classes' => $this->classeProdutoService->listagemClasseProdutos($request->route('cnpj')),
      ]);
    }
}
