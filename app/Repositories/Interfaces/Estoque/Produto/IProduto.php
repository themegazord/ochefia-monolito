<?php

namespace App\Repositories\Interfaces\Estoque\Produto;

use App\Models\Estoque\Produto\Produto;
use Illuminate\Database\Eloquent\Collection;

interface IProduto
{
  public function cadastro(array $produto): Produto;
  public function listagemProdutosPorEmpresa(int $empresa_id): Collection;
  public function consultaProdutoPorEmpresa(int $empresa_id, int $produto_id): ?Produto;
  public function edicaoProdutoPorEmpresa(array $produto): int;
  public function remocaoProdutoPorEmpresa(int $empresa_id, int $produto_id): mixed;
}