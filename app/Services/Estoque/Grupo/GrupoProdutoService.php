<?php

namespace App\Services\Estoque\Grupo;

use App\Exceptions\Empresa\EmpresaException;
use App\Models\GrupoProduto;
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
}