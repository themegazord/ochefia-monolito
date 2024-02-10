<?php

namespace App\Http\Controllers\Autenticacao;

use App\Http\Controllers\Controller;
use App\Utils\States\Navbar\Links;
use Inertia\Response;

class CadastroController extends Controller
{
  public function __construct(
      private readonly Links $links
  )
  {
  }

  public function index(): Response
  {
    return inertia('Autenticacao/CadastroView', [
        'links' => $this->links->getLinks()
    ]);
  }
}
