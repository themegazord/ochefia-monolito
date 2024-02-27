<?php

namespace App\Services\Estoque\Grupo;

use App\Exceptions\Empresa\EmpresaException;
use App\Exceptions\Estoque\GrupoProdutoException;
use App\Models\Estoque\Grupo\GrupoProduto;
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

  /**
   * @throws EmpresaException
   */
  public function cadastroGrupoPorEmpresa(string $cnpj, array $dadosGrupo): EmpresaException|GrupoProduto {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    if (is_null($empresa)) return EmpresaException::CNPJInexistente($cnpj);
    $dadosGrupo['empresa_id'] = $empresa->getAttribute('empresa_id');
    return $this->grupoProdutoRepository->cadastro($dadosGrupo);
  }

  /**
   * @throws EmpresaException
   * @throws GrupoProdutoException
   */
  public function consultaGrupoPorEmpresa(string $cnpj, int $grupo_produto_id): array|EmpresaException {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    if (is_null($empresa)) return EmpresaException::CNPJInexistente($cnpj);
    $grupo = $this->grupoProdutoRepository->grupoPorEmpresa($empresa->getAttribute('empresa_id'), $grupo_produto_id)->toArray();
    return (is_null($grupo)) ? GrupoProdutoException::grupoNaoExiste() : $grupo ;
  }

  /**
   * @throws GrupoProdutoException
   * @throws EmpresaException
   */
  public function editarGrupoPorEmpresa(array $dadosGrupo, string $cnpj): int {
    $this->consultaGrupoPorEmpresa($cnpj, $dadosGrupo['grupo_produto_id']);
    return $this->grupoProdutoRepository->edicaoGrupoPorEmpresa($dadosGrupo);
  }

  /**
   * @throws GrupoProdutoException
   * @throws EmpresaException
   */
  public function removerGrupoPorEmpresa(string $cnpj, int $grupo_produto_id): mixed {
    $grupo = $this->consultaGrupoPorEmpresa($cnpj, $grupo_produto_id);
    return $this->grupoProdutoRepository->deletaGrupoPorEmpresa($grupo[0]['empresa_id'], $grupo_produto_id);
  }
}