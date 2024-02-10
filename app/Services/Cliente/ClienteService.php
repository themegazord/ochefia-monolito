<?php

namespace App\Services\Cliente;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Exceptions\Cliente\ClienteException;
use App\Models\Cliente;
use App\Models\User;
use App\Repositories\Interfaces\Cliente\ICliente;
use App\Services\Autenticacao\CadastroService;

class ClienteService
{
  public function __construct(
      private readonly ICliente        $clienteRepository,
      private readonly CadastroService $cadastroService
  )
  {
  }

  /**
   * @throws ClienteException
   * @throws AutenticacaoException
   */
  public function cadastro(array $cliente): array|ClienteException
  {
    $this->validaCPF($cliente['cliente_cpf']);
    if ($this->clientePorCPF($cliente['cliente_cpf'])) return ClienteException::CPFJaExistente($cliente['cliente_cpf']);
    $usuarioNovo = $this->cadastraUsuario(
        $cliente['cliente_nome'],
        $cliente['cliente_email'],
        $cliente['cliente_senha']
    );
    $cliente['usuario_id'] = $usuarioNovo->getAttribute('id');
    return [
        'cliente' => $this->clienteRepository->cadastro($cliente)
    ];
    // $dadosLogin = $this->logaUsuario(
    //     $cliente['cliente_email'],
    //     $cliente['cliente_senha']
    // );
    // $cliente['cliente_senha'] = $usuarioNovo->getAttribute('password');
  }

  /**
   * @throws ClienteException
   */
  private function validaCPF(string $cpf): bool|ClienteException
  {
    // Extrai somente os números
    $cpf = preg_replace('/[^0-9]/i', '', $cpf);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
      return ClienteException::CPFInvalido($cpf);
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
      return ClienteException::CPFInvalido($cpf);
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        return ClienteException::CPFInvalido($cpf);
      }
    }
    return true;
  }

  private function clientePorCPF(string $cpf): ?Cliente
  {
    return $this->clienteRepository->clientePorCPF($cpf);
  }

  private function cadastraUsuario(string $nome, string $email, string $senha): User|AutenticacaoException
  {
    return $this->cadastroService->cadastro([
        'name' => $nome,
        'email' => $email,
        'password' => $senha
    ]);
  }
}
