<?php

namespace App\Http\Controllers\Autenticacao;

use App\Http\Controllers\Controller;
use App\Utils\States\Navbar\Links;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class LoginController extends Controller
{
  public function __construct(
      private readonly Links $links
  )
  {
  }

  public function index(): Response|ResponseFactory
  {
    return \inertia('Autenticacao/LoginView', [
        'links' => $this->links->getLinks()
    ]);
  }

  public function store(Request $request): RedirectResponse
  {
    //TODO fazer a validacao para devolver se a senha e o email condizem
    Auth::attempt($request->only(['email', 'password']), $request->get('manterLogado'));
    $usuario = Auth::user();
    if ($usuario && $usuario->funcionario) {
      $empresa = $usuario->funcionario->empresa;
      return redirect($empresa->empresa_cnpj.'/');
    }
    dd($usuario, $usuario->funcionario);
    //TODO criar rota para os clientes logados
//    return to_route('dashboard');
  }

  public function destroy(Request $request): RedirectResponse {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return to_route('login');
  }
}
