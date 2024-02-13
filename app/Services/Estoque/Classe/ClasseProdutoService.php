<?php

namespace App\Services\Estoque\Classe;

use App\Repositories\Interfaces\Estoque\Classe\IClasseProduto;

class ClasseProdutoService
{
  public function __construct(
    private readonly IClasseProduto $classeProdutoRepository
  ){}

  public function listagemClasseProdutos(string $empresa_id): array {
    return $this->classeProdutoRepository->listagemClasseProduto($empresa_id);
  }
}