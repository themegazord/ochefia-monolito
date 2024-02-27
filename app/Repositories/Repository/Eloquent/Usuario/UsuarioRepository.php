<?php

namespace App\Repositories\Repository\Eloquent\Usuario;

use App\Models\Autenticacao\User;
use App\Repositories\Interfaces\Usuario\IUsuario;

class UsuarioRepository implements IUsuario
{
  public function cadastro(array $credenciais): User
  {
    return User::query()
        ->create($credenciais);
  }

  public function usuarioPorEmail(string $email): ?User
  {
    return User::query()
        ->where('email', $email)
        ->first();
  }
}
