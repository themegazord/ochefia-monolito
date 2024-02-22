<?php

namespace App\Repositories\Interfaces\Estoque\Fabricante;

use App\Models\FabricanteProduto;
use Illuminate\Support\Collection;

interface IFabricanteProduto
{
  public function cadastro(array $fabricante): FabricanteProduto;
  public function fabricanteProdutoPorNome(string $nomeFabricante): ?FabricanteProduto;
  public function listagemFabricantes(int $empresa_id): Collection;
  public function fabricantePorId(int $empresa_id, int $fabricante_produto_id): ?FabricanteProduto;
  public function atualizaFabricantePorEmpresa(array $fabricante): int ;
  public function removeFabricantePorId(int $id): mixed;
}