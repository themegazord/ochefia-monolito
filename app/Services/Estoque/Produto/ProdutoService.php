<?php

namespace App\Services\Estoque\Produto;

use App\Exceptions\Estoque\ClasseProdutoException;
use App\Exceptions\Estoque\FabricanteProdutoException;
use App\Exceptions\Estoque\GrupoProdutoException;
use App\Exceptions\Estoque\ProdutoException;
use App\Exceptions\Estoque\SubGrupoProdutoException;
use App\Exceptions\Estoque\UnidadeProdutoException;
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

  public function consultaNecessidadesCadastroProdutoPorEmpresa(string $cnpj): array
  {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    return [
      'grupos' => $empresa->grupo_produto()->get([
        'grupo_produto_id',
        'grupo_produto_nome'
      ])->toArray(),
      'subgrupos' => $empresa->subgrupo_produto()->get([
        'subgrupo_produto_id',
        'subgrupo_produto_nome'
      ])->toArray(),
      'fabricantes' => $empresa->fabricante_produto()->get([
        'fabricante_produto_id',
        'fabricante_produto_nome',
      ])->toArray(),
      'classes' => $empresa->classe_produto()->get([
        'classe_produto_id',
        'classe_produto_nome',
      ])->toArray(),
      'unidades' => $empresa->unidade_produto()->get([
        'unidade_produto_id',
        'unidade_produto_nome',
      ])->toArray()
    ];
  }

  /**
   * @throws GrupoProdutoException
   * @throws ClasseProdutoException
   * @throws SubGrupoProdutoException
   * @throws UnidadeProdutoException
   * @throws FabricanteProdutoException
   */
  public function cadastraProdutoPorEmpresa(array $produto, string $cnpj): \App\Models\Estoque\Produto\Produto
  {
    $produto = $this->validaExistenciaDependencias($produto, $cnpj);
    $produto['produto_estoque'] = intval($produto['produto_estoque']);
    $produto['produto_preco'] = floatval($produto['produto_preco']);
    return $this->produtoRepository->cadastro($produto);
  }

  /**
   * @throws ProdutoException
   */
  public function consultaProdutoPorEmpresa(string $cnpj, int $produto_id) {
    $produto = $this->produtoRepository->consultaProdutoPorEmpresa($this->empresaService->empresaPorCnpj($cnpj)->getAttribute('empresa_id'), $produto_id);
    return is_null($produto) ? ProdutoException::produtoInexistente() : $produto;
  }

  /**
   * @throws GrupoProdutoException
   * @throws ProdutoException
   * @throws ClasseProdutoException
   * @throws SubGrupoProdutoException
   * @throws UnidadeProdutoException
   * @throws FabricanteProdutoException
   */
  public function editaProdutoPorEmpresa(array $produto, string $cnpj): int
  {
    $this->consultaProdutoPorEmpresa($cnpj, $produto['produto_id']);
    $produto = $this->validaExistenciaDependencias($produto, $cnpj);
    $produto['produto_estoque'] = intval($produto['produto_estoque']);
    $produto['produto_preco'] = floatval($produto['produto_preco']);
    return $this->produtoRepository->edicaoProdutoPorEmpresa($produto);
  }

  /**
   * @throws GrupoProdutoException
   * @throws SubGrupoProdutoException
   * @throws ClasseProdutoException
   * @throws FabricanteProdutoException
   * @throws UnidadeProdutoException
   */
  protected function validaExistenciaDependencias(array $produto, string $cnpj): GrupoProdutoException|FabricanteProdutoException|UnidadeProdutoException|array|ClasseProdutoException|SubGrupoProdutoException
  {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    if (empty($produto['grupo_produto_id'])  || is_null($empresa->grupo_produto()->where('grupo_produto_id', $produto['grupo_produto_id'])->first())) return GrupoProdutoException::grupoNaoExiste();
    if (empty($produto['subgrupo_produto_id'])  || is_null($empresa->subgrupo_produto()->where('subgrupo_produto_id', $produto['subgrupo_produto_id'])->first())) return SubGrupoProdutoException::subGrupoInexistente();
    if (empty($produto['classe_produto_id'])  || is_null($empresa->classe_produto()->where('classe_produto_id', $produto['classe_produto_id'])->first())) return ClasseProdutoException::classeInexistente();
    if (empty($produto['fabricante_produto_id'])  || is_null($empresa->fabricante_produto()->where('fabricante_produto_id', $produto['fabricante_produto_id'])->first())) return FabricanteProdutoException::fabricanteInexiste();
    if (empty($produto['unidade_produto_id'])  || is_null($empresa->unidade_produto()->where('unidade_produto_id', $produto['unidade_produto_id'])->first())) return UnidadeProdutoException::unidadeInexistente();
    $produto['empresa_id'] = $empresa->getAttribute('empresa_id');
    return $produto;
  }
}