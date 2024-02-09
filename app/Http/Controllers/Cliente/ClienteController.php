<?php

namespace App\Http\Controllers\Cliente;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Exceptions\Cliente\ClienteException;
use App\Http\Controllers\Controller;
use App\Services\Cliente\ClienteService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(
        private readonly ClienteService $clienteService
    ) {
    }
    public function store(Request $request): RedirectResponse
    {
        try {
            $this->clienteService->cadastro($request->only([
                'cliente_nome',
                'cliente_email',
                'cliente_senha',
                'cliente_cpf',
                'cliente_telefone_pessoal',
                'cliente_telefone_contato'
            ]));
            return back()->with(
                'bfm',
                [
                    'tipo' => 'sucesso',
                    'titulo' => 'Cadastro concluído',
                    'notificacao' => 'Cadastro concluído com sucesso'
                ]
            );
        } catch (ClienteException $ce) {
            return back()->with(
                'bfm',
                [
                    'tipo' => 'erro',
                    'titulo' => 'Erro no cadastro',
                    'notificacao' => $ce->getMessage()
                ]
            );
        } catch (AutenticacaoException $ae) {
            return back()->with(
                'bfm',
                [
                    'tipo' => 'erro',
                    'titulo' => 'Erro na autenticação',
                    'notificacao' => $ae->getMessage()
                ]
            );
        }
    }
}
