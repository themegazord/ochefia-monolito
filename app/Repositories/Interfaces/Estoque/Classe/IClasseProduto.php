<?php

namespace App\Repositories\Interfaces\Estoque\Classe;

use App\Models\Estoque\Classe\ClasseProduto;

interface IClasseProduto
{
  public function cadastro(array $classeProduto): ClasseProduto;
  public function classeProdutoPorNome(string $nomeClasseProduto): ?ClasseProduto;
  public function listagemClasseProduto(string $empresa_id): array;
  public function classeProdutoPorId(int $id):?ClasseProduto;
  public function atualizaClassePorIdEEmpresa(array $classe): int;
  public function removeClassePorId(int $empresa_id, int $classe_id): mixed;
}