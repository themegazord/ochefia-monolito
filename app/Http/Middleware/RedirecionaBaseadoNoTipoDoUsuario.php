<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirecionaBaseadoNoTipoDoUsuario
{
  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $user = $request->user();

    if ($user->funcionario) {
      $funcionario = $user->funcionario;
      $empresa = $funcionario->empresa;
      if ($empresa->empresa_cnpj === $request->route('cnpj')) {
        return $next($request);
      }
    }

    return to_route('login');
  }
}
