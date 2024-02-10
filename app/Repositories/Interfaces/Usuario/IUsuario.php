<?php

namespace App\Repositories\Interfaces\Usuario;

use App\Models\User;

interface IUsuario
{
  public function cadastro(array $credenciais): User;

  public function usuarioPorEmail(string $email): ?User;
}
