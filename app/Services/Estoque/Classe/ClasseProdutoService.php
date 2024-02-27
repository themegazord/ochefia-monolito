<?php

namespace App\Services\Estoque\Classe;

use App\Exceptions\Empresa\EmpresaException;
use App\Models\Estoque\Classe\ClasseProduto;
use App\Repositories\Interfaces\Estoque\Classe\IClasseProduto;
use App\Services\Empresa\EmpresaService;

class ClasseProdutoService
{
  public function __construct(
    private readonly IClasseProduto $classeProdutoRepository,
    private readonly EmpresaService $empresaService
  ){}

  /**
   * @throws EmpresaException
   */
  public function listagemClasseProdutos(string $cnpj): array|EmpresaException {
    $empresa = $this->empresaService->empresaPorCnpj($cnpj);
    if (is_null($empresa)) return EmpresaException::CNPJInexistente($cnpj);
    return $this->classeProdutoRepository->listagemClasseProduto($empresa->getAttribute('empresa_id'));
  }

  /**
   * @throws EmpresaException
   */
  public function cadastroClasseProdutos(array $dados): ClasseProduto|EmpresaException {
    if (is_null($this->empresaService->empresaPorCnpj($dados['cnpj']))) return EmpresaException::CNPJInexistente($dados['cnpj']);
    return $this->classeProdutoRepository->cadastro([
      'classe_produto_nome' => $dados['classe_produto_nome'],
      'empresa_id' => $this->empresaService->empresaPorCnpj($dados['cnpj'])->getAttribute('empresa_id')
    ]);
  }

  public function consultaClasseProdutoPorId(int $classe_id): ?ClasseProduto {
    return $this->classeProdutoRepository->classeProdutoPorId($classe_id);
  }

  public function atualizaClasseProdutoPorEmpresa(array $dados_classe): int {
    return $this->classeProdutoRepository->atualizaClassePorIdEEmpresa($dados_classe);
  }

  public function deletaClassePorId(string $cnpj, int $classe_id): mixed {
    $empresa_id = $this->empresaService->empresaPorCnpj($cnpj)->getAttribute('empresa_id');
    return $this->classeProdutoRepository->removeClassePorId($empresa_id, $classe_id);
  }
}