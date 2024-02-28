<?php

namespace App\Repositories\Interfaces\Estoque\Unidade;

use App\Models\Estoque\Unidade\UnidadeProduto;
use Illuminate\Database\Eloquent\Collection;

interface IUnidadeProduto
{
  public function cadastro(array $unidade): UnidadeProduto;
  public function listagemUnidadeProdutoPorEmpresa(int $empresa_id): Collection;
  public function unidadeProdutoPorEmpresa(int $empresa_id, int $unidade_produto_id): ?UnidadeProduto;
  public function editaUnidadeProdutoPorEmpresa(array $unidadeProduto): int;
  public function removeUnidadeProdutoPorEmpresa(int $empresa_id, int $unidade_produto_id): mixed;
}