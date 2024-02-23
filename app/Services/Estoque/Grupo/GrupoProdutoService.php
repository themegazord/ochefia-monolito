<?php

namespace App\Services\Estoque\Grupo;

use App\Repositories\Interfaces\Estoque\Grupo\IGrupoProduto;
use App\Services\Empresa\EmpresaService;

class GrupoProdutoService
{

  public function __construct(
    private readonly IGrupoProduto $grupoProdutoRepository,
    private readonly EmpresaService $empresaService
  )
  {}

  public function listagemGrupoPorEmpresa(string $cnpj): array {
    return $this->grupoProdutoRepository->listagemGrupoPorEmpresa($this->empresaService->empresaPorCnpj($cnpj)->getAttribute('empresa_id'))->toArray();
  }
}