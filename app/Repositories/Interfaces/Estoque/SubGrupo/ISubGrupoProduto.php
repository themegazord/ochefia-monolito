<?php

namespace App\Repositories\Interfaces\Estoque\SubGrupo;

use App\Models\Estoque\SubGrupo\SubGrupoProduto;
use Illuminate\Database\Eloquent\Collection;

interface ISubGrupoProduto
{
  public function cadastro(array $subGrupo): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model;
  public function subGrupoPorEmpresa(int $empresa_id, int $subgrupo_produto_id): ?SubGrupoProduto;
  public function listagemSubGrupoPorEmpresa(int $empresa_id): array|\Illuminate\Database\Eloquent\Collection;
  public function atualizaSubGrupoPorEmpresa(array $subgrupo): int;
  public function remocaoSubGrupoPorEmpresa(int $empresa_id, int $subgrupo_produto_id): mixed;
}