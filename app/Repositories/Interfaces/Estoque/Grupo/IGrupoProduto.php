<?php

namespace App\Repositories\Interfaces\Estoque\Grupo;

use App\Models\Estoque\Grupo\GrupoProduto;
use Illuminate\Support\Collection;

interface IGrupoProduto
{
  public function cadastro(array $grupoProduto): GrupoProduto;

  public function grupoProdutoPorNome(string $grupoNome): ?GrupoProduto;

  public function grupoPorEmpresa(int $empresa_id, int $grupo_produto_id): Collection;

  public function listagemGrupoPorEmpresa(int $empresa_id): Collection;

  public function edicaoGrupoPorEmpresa(array $grupo): int;

  public function deletaGrupoPorEmpresa(int $empresa_id, int $grupo_produto_id): mixed;
}