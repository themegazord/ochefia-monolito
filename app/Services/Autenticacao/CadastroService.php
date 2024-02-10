<?php

namespace App\Services\Autenticacao;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Models\User;
use App\Repositories\Interfaces\Usuario\IUsuario;
use Illuminate\Support\Facades\Hash;

class CadastroService
{
  public function __construct(
      private readonly IUsuario $usuarioRepository
  )
  {
  }

  public function cadastro(array $credenciais): User|AutenticacaoException
  {
    if ((bool)$this->usuariosPorEmail($credenciais['email'])) return AutenticacaoException::emailJaVinculadoAUmUsuario();
    $credenciais['password'] = Hash::make($credenciais['password']);
    return $this->usuarioRepository->cadastro($credenciais);
  }

  private function usuariosPorEmail(string $email): ?User
  {
    return $this->usuarioRepository->usuarioPorEmail($email);
  }
}
