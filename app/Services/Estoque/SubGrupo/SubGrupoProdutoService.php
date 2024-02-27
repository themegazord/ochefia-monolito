<?php

namespace App\Services\Estoque\SubGrupo;

use App\Exceptions\Empresa\EmpresaException;
use App\Exceptions\Estoque\SubGrupoProdutoException;
use App\Models\Estoque\SubGrupo\SubGrupoProduto;
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

  public function cadastroSubGrupoPorEmpresa(array $dados, string $cnpj): array {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    $dados['empresa_id'] = $empresa->getAttribute('empresa_id');
    return $this->subGrupoProdutoRepository->cadastro($dados)->toArray();
  }

  /**
   * @throws SubGrupoProdutoException
   */
  public function consultaSubGrupoPorEmpresa(string $cnpj, int $subgrupo_produto_id): SubGrupoProduto|SubGrupoProdutoException {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    $subgrupo = $this->subGrupoProdutoRepository->subGrupoPorEmpresa($empresa->getAttribute('empresa_id'), $subgrupo_produto_id);
    return (is_null($subgrupo)) ? SubGrupoProdutoException::subGrupoInexistente() : $subgrupo;
  }

  /**
   * @throws SubGrupoProdutoException
   */
  public function editaSubGrupoPorEmpresa(array $dados, string $cnpj): int
  {
    $this->consultaSubGrupoPorEmpresa($cnpj, $dados['subgrupo_produto_id']);
    return $this->subGrupoProdutoRepository->atualizaSubGrupoPorEmpresa($dados);
  }

  public function removeSubGrupoPorEmpresa(string $cnpj, int $subgrupo_produto_id): mixed {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    return $this->subGrupoProdutoRepository->remocaoSubGrupoPorEmpresa($empresa->getAttribute('empresa_id'), $subgrupo_produto_id);
  }
}