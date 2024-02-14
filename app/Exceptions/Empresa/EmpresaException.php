<?php

namespace App\Exceptions\Empresa;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class EmpresaException extends Exception
{
  /**
   * @throws EmpresaException
   */
  public static function CNPJInvalido(string $cnpj): self
  {
    throw new self('O CNPJ ' . $cnpj . ' é inválido, por favor, verificar.', Response::HTTP_BAD_REQUEST);
  }

  /**
   * @throws EmpresaException
   */
  public static function CNPJExistente(string $cnpj): self
  {
    throw new self('O CNPJ ' . $cnpj . ' já existe no sistema, por favor, conecte-se com seu usuário vinculado a ele', Response::HTTP_CONFLICT);
  }

  /**
   * @throws EmpresaException
   */
  public static function CNPJInexistente(string $cnpj): self
  {
    throw new self('O CNPJ ' . $cnpj . ' não existe no sistema, por favor, conecte-se com seu usuário vinculado a uma empresa válida', Response::HTTP_NOT_FOUND);
  }
}
