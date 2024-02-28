<?php

namespace App\Services\Estoque\Produto;

use App\Repositories\Interfaces\Estoque\Produto\IProduto;
use App\Services\Empresa\EmpresaService;

class ProdutoService
{
  public function __construct(
    private readonly IProduto       $produtoRepository,
    private readonly EmpresaService $empresaService
  )
  {
  }

  public function listagemProdutoPorEmpresa(string $cnpj)
  {
    return $this->produtoRepository->listagemProdutosPorEmpresa($this->empresaService->empresaPorCnpj($cnpj)->getAttribute('empresa_id'));
  }
}