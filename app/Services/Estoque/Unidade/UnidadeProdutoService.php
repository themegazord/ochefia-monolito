<?php

namespace App\Services\Estoque\Unidade;

use App\Repositories\Interfaces\Estoque\Unidade\IUnidadeProduto;
use App\Services\Empresa\EmpresaService;

class UnidadeProdutoService
{
  public function __construct(
    private readonly IUnidadeProduto $unidadeProdutoRepository,
    private readonly EmpresaService $empresaService
  )
  {}

  public function listagemUnidadeProdutoPorEmpresa(string $cnpj): \Illuminate\Database\Eloquent\Collection
  {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    return $this->unidadeProdutoRepository->listagemUnidadeProdutoPorEmpresa($empresa->getAttribute('empresa_id'));
  }
}