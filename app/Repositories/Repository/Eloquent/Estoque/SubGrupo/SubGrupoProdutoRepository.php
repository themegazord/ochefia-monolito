<?php

namespace App\Repositories\Repository\Eloquent\Estoque\SubGrupo;

use App\Models\Estoque\SubGrupo\SubGrupoProduto;
use App\Repositories\Interfaces\Estoque\SubGrupo\Collection;
use App\Repositories\Interfaces\Estoque\SubGrupo\ISubGrupoProduto;

class SubGrupoProdutoRepository implements ISubGrupoProduto
{

    public function cadastro(array $subGrupo): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
    {
        return SubGrupoProduto::query()
          ->create($subGrupo);
    }

    public function subGrupoPorEmpresa(int $empresa_id, int $subgrupo_produto_id): ?SubGrupoProduto
    {
        return SubGrupoProduto::query()
          ->where('empresa_id', $empresa_id)
          ->where('subgrupo_produto_id', $subgrupo_produto_id)
          ->get([
            'subgrupo_produto_id',
            'empresa_id',
            'subgrupo_produto_nome'
          ]);
    }

    public function listagemSubGrupoPorEmpresa(int $empresa_id): array|\Illuminate\Database\Eloquent\Collection
    {
        return SubGrupoProduto::query()
          ->where('empresa_id', $empresa_id)
          ->get([
            'subgrupo_produto_id',
            'empresa_id',
            'subgrupo_produto_nome'
          ]);
    }

    public function atualizaSubGrupoPorEmpresa(array $subgrupo): int
    {
        return SubGrupoProduto::query()
          ->where('empresa_id', $subgrupo['empresa_id'])
          ->where('subgrupo_produto_id', $subgrupo['subgrupo_produto_id'])
          ->update($subgrupo);
    }

    public function remocaoSubGrupoPorEmpresa(int $empresa_id, int $subgrupo_produto_id): mixed
    {
        return SubGrupoProduto::query()
          ->where('empresa_id', $empresa_id)
          ->where('subgrupo_produto_id', $subgrupo_produto_id)
          ->delete();
    }
}