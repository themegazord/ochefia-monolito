<?php

namespace App\Services\Estoque\Fabricante;

use App\Repositories\Interfaces\Estoque\Fabricante\IFabricanteProduto;
use App\Services\Empresa\EmpresaService;

class FabricanteProdutoService {
  public function __construct(
    private readonly IFabricanteProduto $fabricanteProdutoRepository,
    private readonly EmpresaService $empresaService
  )
  {
  }

  public function listagemFabricantePorEmpresa(string $empresa_cnpj): array {
    return $this->fabricanteProdutoRepository->listagemFabricantes($this->empresaService->empresaPorCnpj($empresa_cnpj)->getAttribute('empresa_id'))->toArray();
  }
}