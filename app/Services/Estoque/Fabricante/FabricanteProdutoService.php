<?php

namespace App\Services\Estoque\Fabricante;

use App\Exceptions\Empresa\EmpresaException;
use App\Models\FabricanteProduto;
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

  /**
   * @throws EmpresaException
   */
  public function cadastrarFabricantePorEmpresa(array $dados): FabricanteProduto|EmpresaException {
    $empresa = $this->empresaService->empresaPorCnpj($dados['cnpj']);
    if (is_null($empresa)) return EmpresaException::CNPJInexistente($dados['cnpj']);
    return $this->fabricanteProdutoRepository->cadastro([
      'empresa_id' => $empresa->getAttribute('empresa_id'),
      'fabricante_produto_nome' => $dados['fabricante_produto_nome']
    ]);
  }
}