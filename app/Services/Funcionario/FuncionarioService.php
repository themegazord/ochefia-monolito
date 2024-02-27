<?php

namespace App\Services\Funcionario;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Exceptions\Funcionario\FuncionarioException;
use App\Models\Autenticacao\User;
use App\Models\Funcionario\Funcionario;
use App\Repositories\Interfaces\Funcionario\IFuncionario;
use App\Services\Autenticacao\CadastroService;
use App\Services\Empresa\EmpresaService;
use Illuminate\Database\Eloquent\Collection;

class FuncionarioService
{
  public function __construct(
      private readonly IFuncionario    $funcionarioRepository,
      private readonly CadastroService $cadastroService,
      private readonly EmpresaService  $empresaService
  )
  {
  }

  /**
   * @throws FuncionarioException
   */
  public function cadastro(array $funcionario): array|FuncionarioException
  {
    /**
     * Validação para verificar se o email já está cadastrada nesta empresa em especifico
     */
    if ((bool)$this->funcionarioPorEmailEEmpresa($funcionario['funcionario_email'], $funcionario['empresa_id'])) return FuncionarioException::emailDeFuncionarioJaExistenteParaEssaEmpresa($funcionario['funcionario_email']);
    /**
     * Validação para garantir que o primeiro funcionário SEMPRE seja o dono
     */
    if (!$this->verificaSeJaExisteFuncionarioNaEmpresa($funcionario['empresa_id']) && !$this->verificaSeOCargoPassadoFoiDono($funcionario['cargo'])) {
      $funcionario['cargo'] = 'DONO';
    }
    $funcionario['cargo'] = strtoupper($funcionario['cargo']);
    /**
     * Faz com que todo dono tenho acesso ao todo sistema
     */
    if ($funcionario['cargo'] === 'DONO' && $funcionario['acessos'] !== ['*']) {
      $funcionario['acessos'] = ['*'];
    }
    $funcionario['acessos'] = $this->converteArrayDeAcessosParaString($funcionario['acessos']);

    /**
     * Verifica se a quantidade de donos cadastrados no sistema excedeu o limite configurado na empresa
     */
    if ($funcionario['cargo'] === 'DONO') $this->verificaSeAQuantidadeDeDonosExcedeu($funcionario['empresa_id']);

    $usuarioNovo = $this->gerandoNovoUsuario($funcionario['funcionario_nome'], $funcionario['funcionario_email'], $funcionario['funcionario_senha']);
    $funcionario['usuario_id'] = $usuarioNovo->getAttribute('id');
    $funcionario['funcionario_senha'] = $usuarioNovo->getAttribute('password');
    return [
        'funcionario' => $this->funcionarioRepository->cadastro($funcionario),
    ];
  }

  private function funcionarioPorEmailEEmpresa(string $email, int $empresa_id): ?Funcionario
  {
    return $this->funcionarioRepository->funcionarioPorEmailEEmpresa($email, $empresa_id);
  }

  private function listagemDeFuncionarioPorEmpresa(int $empresa_id): Collection
  {
    return $this->funcionarioRepository->listagemDeFuncionarioPorEmpresa($empresa_id);
  }

  private function verificaSeJaExisteFuncionarioNaEmpresa(int $empresa_id): bool
  {
    return (bool)$this->listagemDeFuncionarioPorEmpresa($empresa_id)->toArray();
  }

  private function verificaSeOCargoPassadoFoiDono(string $cargo): bool
  {
    return strtoupper($cargo) === 'DONO';
  }

  private function converteArrayDeAcessosParaString(array $acessos): string
  {
    return implode(';', $acessos);
  }

  private function gerandoNovoUsuario(string $nome, string $email, string $senha): User|AutenticacaoException
  {
    $usuario = [
        'name' => $nome,
        'email' => $email,
        'password' => $senha
    ];

    return $this->cadastroService->cadastro($usuario);
  }

  /**
   * @throws FuncionarioException
   */
  private function verificaSeAQuantidadeDeDonosExcedeu(int $empresa_id): void
  {
    $quantidadeDeDonosConfigurada = $this->empresaService->quantidadeDeDonoPorEmpresa($empresa_id)->getAttribute('quantidade_donos');
    $quantidadeDeDonos = count($this->funcionarioRepository->listagemDeDonosPorEmpresa($empresa_id)->toArray());

    if ($quantidadeDeDonosConfigurada <= $quantidadeDeDonos) FuncionarioException::quantidadeDeDonosAtingidaPorEmpresa();

  }
}
