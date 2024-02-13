<?php

namespace App\Repositories\Interfaces\Estoque\Classe;

use App\Models\ClasseProduto;

interface IClasseProduto
{
  public function cadastro(array $classeProduto): ClasseProduto;
  public function classeProdutoPorNome(string $nomeClasseProduto): ?ClasseProduto;
  public function listagemClasseProduto(string $empresa_id): array;
  public function classeProdutoPorId(int $id):?ClasseProduto;
  public function atualizaClassePorId(array $classe, int $id): int;
  public function removeClassePorId(int $id): mixed;
}