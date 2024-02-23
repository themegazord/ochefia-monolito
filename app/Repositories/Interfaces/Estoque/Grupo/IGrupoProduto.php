<?php

namespace App\Repositories\Interfaces\Estoque\Grupo;

use App\Models\GrupoProduto;
use Illuminate\Support\Collection;

interface IGrupoProduto
{
  public function cadastro(array $grupoProduto): GrupoProduto;

  public function grupoProdutoPorNome(string $grupoNome): ?GrupoProduto;

  public function grupoPorEmpresa(int $empresa_id, int $grupo_produto_id): Collection;

  public function listagemGrupoPorEmpresa(int $empresa_id): Collection;

  public function edicaoGrupoPorId(array $grupo, int $id): int;

  public function deletaGrupoPorId(int $id): mixed;
}