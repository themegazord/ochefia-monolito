<?php

namespace App\Exceptions\Estoque;

use Exception;
use Symfony\Component\HttpFoundation\Response;


class UnidadeProdutoException extends Exception
{
  /**
   * @throws UnidadeProdutoException
   */
  public static function unidadeDeMedidaJaExiste(string $unidade_nome): self {
    throw new self('A unidade de medida ' . strtoupper($unidade_nome) . ' já existe, cadastre uma nova ou use-a', Response::HTTP_CONFLICT);
  }

  /**
   * @throws UnidadeProdutoException
   */
  public static function unidadeInexistente(): self {
    throw new self('A unidade de medida é inexistente.', Response::HTTP_NOT_FOUND);
  }
}
