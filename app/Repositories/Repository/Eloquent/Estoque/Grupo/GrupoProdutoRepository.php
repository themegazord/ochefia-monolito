<?php

namespace App\Repositories\Repository\Eloquent\Estoque\Grupo;

use App\Models\Estoque\Grupo\GrupoProduto;
use App\Repositories\Interfaces\Estoque\Grupo\IGrupoProduto;
use Illuminate\Support\Collection;

class GrupoProdutoRepository implements IGrupoProduto
{

  public function cadastro(array $grupoProduto): GrupoProduto
  {
    return GrupoProduto::query()
      ->create($grupoProduto);
  }

  public function grupoProdutoPorNome(string $grupoNome): ?GrupoProduto
  {
    return GrupoProduto::query()
      ->where('grupo_produto_nome', $grupoNome)
      ->first();
  }

  public function grupoPorEmpresa(int $empresa_id, int $grupo_produto_id): Collection
  {
    return GrupoProduto::query()
      ->where('empresa_id', $empresa_id)
      ->where('grupo_produto_id', $grupo_produto_id)
      ->get([
        'empresa_id',
        'grupo_produto_id',
        'grupo_produto_nome',
        'grupo_produto_tipo'
      ]);
  }

  public function listagemGrupoPorEmpresa(int $empresa_id): Collection
  {
    return GrupoProduto::query()
      ->where('empresa_id', $empresa_id)
      ->get([
        'grupo_produto_id',
        'grupo_produto_nome',
        'grupo_produto_tipo'
      ]);
  }

  public function edicaoGrupoPorEmpresa(array $grupo): int
  {
    return GrupoProduto::query()
      ->where('empresa_id', $grupo['empresa_id'])
      ->where('grupo_produto_id', $grupo['grupo_produto_id'])
      ->update($grupo);
  }

  public function deletaGrupoPorEmpresa(int $empresa_id, int $grupo_produto_id): mixed
  {
    return GrupoProduto::query()
      ->where('empresa_id', $empresa_id)
      ->where('grupo_produto_id', $grupo_produto_id)
      ->delete();
  }
}