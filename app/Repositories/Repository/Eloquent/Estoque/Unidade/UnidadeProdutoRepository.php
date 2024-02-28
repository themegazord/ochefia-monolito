<?php

namespace App\Repositories\Repository\Eloquent\Estoque\Unidade;

use App\Models\Estoque\Unidade\UnidadeProduto;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\Estoque\Unidade\IUnidadeProduto;

class UnidadeProdutoRepository implements IUnidadeProduto
{

    public function cadastro(array $unidade): UnidadeProduto
    {
        return UnidadeProduto::query()
          ->create($unidade);
    }

    public function listagemUnidadeProdutoPorEmpresa(int $empresa_id): Collection
    {
        return UnidadeProduto::query()
          ->where('empresa_id', $empresa_id)
          ->get([
            'unidade_produto_id',
            'empresa_id',
            'unidade_produto_nome'
          ]);
    }

    public function unidadeProdutoPorEmpresa(int $empresa_id, int $unidade_produto_id): ?UnidadeProduto
    {
        return UnidadeProduto::query()
          ->where('empresa_id', $empresa_id)
          ->where('unidade_produto_id', $unidade_produto_id)
          ->first([
            'unidade_produto_id',
            'empresa_id',
            'unidade_produto_nome'
          ]);
    }

    public function editaUnidadeProdutoPorEmpresa(array $unidadeProduto): int
    {
        return UnidadeProduto::query()
          ->where('empresa_id', $unidadeProduto['empresa_id'])
          ->where('unidade_produto_id', $unidadeProduto['unidade_produto_id'])
          ->update($unidadeProduto);
    }

    public function removeUnidadeProdutoPorEmpresa(int $empresa_id, int $unidade_produto_id): mixed
    {
        return UnidadeProduto::query()
          ->where('empresa_id', $empresa_id)
          ->where('unidade_produto_id', $unidade_produto_id)
          ->delete();
    }
}