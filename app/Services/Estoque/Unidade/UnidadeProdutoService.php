<?php

namespace App\Services\Estoque\Unidade;

use App\Exceptions\Estoque\UnidadeProdutoException;
use App\Repositories\Interfaces\Estoque\Unidade\IUnidadeProduto;
use App\Services\Empresa\EmpresaService;

class UnidadeProdutoService
{
  public function __construct(
    private readonly IUnidadeProduto $unidadeProdutoRepository,
    private readonly EmpresaService  $empresaService
  )
  {
  }

  public function listagemUnidadeProdutoPorEmpresa(string $cnpj): \Illuminate\Database\Eloquent\Collection
  {
    return $this->unidadeProdutoRepository->listagemUnidadeProdutoPorEmpresa($this->empresaService->empresaPorCnpj($cnpj)->getAttribute('empresa_id'));
  }

  public function cadastroUnidadeProdutoPorEmpresa(string $cnpj, array $unidade): \App\Models\Estoque\Unidade\UnidadeProduto
  {
    $unidade['empresa_id'] = $this->empresaService->empresaPorCnpj($cnpj)->getAttribute('empresa_id');
    $unidade = $this->alterarSiglaParaUppercase($unidade);
    return $this->unidadeProdutoRepository->cadastro($unidade);
  }

  /**
   * @throws UnidadeProdutoException
   */
  public function consultaUnidadeProdutoPorEmpresa(string $cnpj, int $unidade_produto_id): UnidadeProdutoException|\App\Models\Estoque\Unidade\UnidadeProduto
  {
    $unidade = $this->unidadeProdutoRepository->unidadeProdutoPorEmpresa($this->empresaService->empresaPorCnpj($cnpj)->getAttribute('empresa_id'), $unidade_produto_id);
    return (is_null($unidade)) ? UnidadeProdutoException::unidadeInexistente() : $unidade;
  }

  /**
   * @throws UnidadeProdutoException
   */
  public function edicaoUnidadeProdutoPorEmpresa(array $unidade, string $cnpj): int
  {
    $this->consultaUnidadeProdutoPorEmpresa($cnpj, $unidade['unidade_produto_id']);
    return $this->unidadeProdutoRepository->editaUnidadeProdutoPorEmpresa($this->alterarSiglaParaUppercase($unidade));
  }

  public function removeUnidadeProdutoPorEmpresa(string $cnpj, string $unidade_produto_id): mixed
  {
    return $this->unidadeProdutoRepository->removeUnidadeProdutoPorEmpresa($this->empresaService->empresaPorCnpj($cnpj)->getAttribute('empresa_id'), $unidade_produto_id);
  }

  protected function alterarSiglaParaUppercase(array $unidade): array
  {
    $unidade['unidade_produto_sigla'] = strtoupper($unidade['unidade_produto_sigla']);
    return $unidade;
  }
}