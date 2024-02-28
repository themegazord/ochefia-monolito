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

  public function cadastroUnidadeProdutoPorEmpresa(string $cnpj, array $unidade): \App\Models\Estoque\Unidade\UnidadeProduto
  {
    $unidade['empresa_id'] = $this->empresaService->empresaPorCnpj($cnpj)->getAttribute('empresa_id');
    $unidade = $this->alterarSiglaParaUppercase($unidade);
    return $this->unidadeProdutoRepository->cadastro($unidade);
  }

  protected function alterarSiglaParaUppercase(array $unidade): array {
    $unidade['unidade_produto_sigla'] = strtoupper($unidade['unidade_produto_sigla']);
    return $unidade;
  }
}