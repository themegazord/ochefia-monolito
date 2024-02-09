<?php

namespace App\Repositories\Repository\Eloquent\Funcionario;

use App\Models\Funcionario;
use App\Repositories\Interfaces\Funcionario\IFuncionario;
use Illuminate\Database\Eloquent\Collection;

class FuncionarioRepository implements IFuncionario {
    public function cadastro(array $funcionario): Funcionario
    {
        return Funcionario::query()
            ->create($funcionario);
    }

    public function funcionarioPorEmailEEmpresa(string $email, int $empresa_id): ?Funcionario
    {
        return Funcionario::query()
            ->where('funcionario_email', $email)
            ->where('empresa_id', $empresa_id)
            ->first();
    }

    public function listagemDeFuncionarioPorEmpresa(int $empresa_id): Collection
    {
        return Funcionario::query()
            ->where('empresa_id', $empresa_id)
            ->get();
    }

    public function listagemDeDonosPorEmpresa(int $empresa_id): Collection
    {
        return Funcionario::query()
            ->where('empresa_id', $empresa_id)
            ->where('cargo', 'DONO')
            ->get();
    }

    public function funcionarioPorEmail(string $email): ?Funcionario
    {
        return Funcionario::query()
            ->where('funcionario_email', $email)
            ->first();
    }
}
