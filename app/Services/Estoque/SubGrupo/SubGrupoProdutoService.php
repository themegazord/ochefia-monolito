<?php

namespace App\Services\Estoque\SubGrupo;

use App\Exceptions\Empresa\EmpresaException;
use App\Repositories\Interfaces\Estoque\SubGrupo\ISubGrupoProduto;
use App\Services\Empresa\EmpresaService;

class SubGrupoProdutoService
{
  public function __construct(
    private readonly ISubGrupoProduto $subGrupoProdutoRepository,
    private readonly EmpresaService $empresaService
  )
  {
  }

  public function listagemSubGrupoPorEmpresa(string $cnpj): array {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    return $this->subGrupoProdutoRepository->listagemSubGrupoPorEmpresa($empresa->getAttribute('empresa_id'))->toArray();
  }
}