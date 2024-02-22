<?php

namespace App\Repositories\Repository\Eloquent\Estoque\Fabricante;

use App\Models\FabricanteProduto;
use App\Repositories\Interfaces\Estoque\Fabricante\IFabricanteProduto;

class FabricanteProdutoRepository implements IFabricanteProduto
{
  public function cadastro(array $fabricante): FabricanteProduto
  {
    return FabricanteProduto::query()
      ->create($fabricante);
  }

  public function fabricanteProdutoPorNome(string $nomeFabricante): ?FabricanteProduto
  {
    return FabricanteProduto::query()
      ->where('fabricante_produto_nome', $nomeFabricante)
      ->first();
  }

  public function listagemFabricantes(int $empresa_id): \Illuminate\Support\Collection
  {
    return FabricanteProduto::query()
      ->where('empresa_id', $empresa_id)
      ->get([
        'fabricante_produto_id',
        'fabricante_produto_nome'
      ]);
  }

  public function fabricantePorId(int $empresa_id, int $fabricante_produto_id): ?FabricanteProduto
  {
    return FabricanteProduto::query()
      ->where('empresa_id', $empresa_id)
      ->where('fabricante_produto_id', $fabricante_produto_id)
      ->first([
        'fabricante_produto_id',
        'empresa_id',
        'fabricante_produto_nome'
      ]);
  }

  public function atualizaFabricantePorEmpresa(array $fabricante): int
  {
    return FabricanteProduto::query()
      ->where('empresa_id', $fabricante['empresa_id'])
      ->where('fabricante_produto_id', $fabricante['fabricante_produto_id'])
      ->update($fabricante);
  }

  public function removeFabricantePorId(int $id): mixed
  {
    return FabricanteProduto::query()
      ->where('fabricante_produto_id', $id)
      ->delete();
  }
}