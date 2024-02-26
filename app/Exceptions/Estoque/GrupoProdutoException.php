<?php

namespace App\Exceptions\Estoque;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class GrupoProdutoException extends Exception
{
  /**
   * @throws GrupoProdutoException
   */
  public static function tipoGrupoProdutoNaoExistente(string $tipo): self {
    throw new self('O tipo de produto ' . $tipo . ' não existe no sistema, por favor, verificar na documentação', Response::HTTP_NOT_FOUND);
  }

  /**
   * @throws GrupoProdutoException
   */
  public static function grupoProdutoJaExistente(string $grupoNome): self {
    throw new self('O grupo ' . strtoupper($grupoNome) . ' já existe na base de dados, cadastre outro ou use-o.', Response::HTTP_CONFLICT);
  }

  /**
   * @throws GrupoProdutoException
   */
  public static function grupoNaoExiste(): self {
    throw new self('O grupo não existe', Response::HTTP_NOT_FOUND);
  }
}
