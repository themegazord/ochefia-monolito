<?php

namespace App\Repositories\Repository\Eloquent\Estoque\Produto;

use App\Models\Estoque\Produto\Produto;
use App\Repositories\Interfaces\Estoque\Produto\IProduto;
use Illuminate\Database\Eloquent\Collection;

class ProdutoRepository implements IProduto
{

    public function cadastro(array $produto): Produto
    {
        return Produto::query()
          ->create($produto);
    }

    public function listagemProdutosPorEmpresa(int $empresa_id): Collection
    {
        return Produto::query()
          ->where('empresa_id', $empresa_id)
          ->get([
            'produto_id',
            'produto_nome',
            'produto_estoque',
            'produto_preco'
          ]);
    }

    public function consultaProdutoPorEmpresa(int $empresa_id, int $produto_id): ?Produto
    {
        return Produto::query()
          ->where('empresa_id', $empresa_id)
          ->where('produto_id', $produto_id)
          ->first([
            'empresa_id',
            'grupo_produto_id',
            'sub_grupo_produto_id',
            'fabricante_produto_id',
            'classe_produto_id',
            'unidade_produto_id',
            'produto_nome',
            'produto_estoque',
            'produto_preco'
          ]);
    }

    public function edicaoProdutoPorEmpresa(array $produto): int
    {
        return Produto::query()
          ->where('empresa_id', $produto['empresa_id'])
          ->where('produto_id', $produto['produto_id'])
          ->update($produto);
    }

    public function remocaoProdutoPorEmpresa(int $empresa_id, int $produto_id): mixed
    {
        return Produto::query()
          ->where('empresa_id', $empresa_id)
          ->where('produto_id', $produto_id)
          ->delete();
    }
}