<?php

namespace App\Http\Controllers\Empresa;

use App\Exceptions\Autenticacao\AutenticacaoException;
use App\Exceptions\Empresa\EmpresaException;
use App\Exceptions\Funcionario\FuncionarioException;
use App\Http\Controllers\Controller;
use App\Services\Empresa\EmpresaService;
use App\Services\Funcionario\FuncionarioService;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function __construct(
        private readonly EmpresaService $empresaService,
        private readonly FuncionarioService $funcionarioService
    ){}
    public function store(Request $request) {
        try {
            if(!isset($request->toArray()['empresa']['empresa_logo'])) {
                $empresa = $this->empresaService->cadastro($request->toArray()['empresa']);
                $dadosFuncionario = $request->toArray()['dono'];
                $dadosFuncionario['empresa_id'] = $empresa->toArray()['id'];
                $this->funcionarioService->cadastro($dadosFuncionario);
                return to_route('login')->with(
                    'bfm',
                    [
                        'tipo' => 'sucesso',
                        'titulo' => 'Cadastro concluído',
                        'notificacao' => 'Cadastro concluído com sucesso'
                    ]
                );
            }
            if($request->hasFile('empresa.empresa_logo') && $request->file('empresa.empresa_logo')[0]->isValid()) {
                $nomeImagem = $this->empresaService->guardarImagem($request->file('empresa.empresa_logo')[0]);
                $dadosEmpresa = $request->toArray()['empresa'];
                $dadosEmpresa['empresa_logo'] = $nomeImagem;
                $empresa = $this->empresaService->cadastro($dadosEmpresa);
                $dadosFuncionario = $request->toArray()['dono'];
                $dadosFuncionario['empresa_id'] = $empresa->toArray()['id'];
                $this->funcionarioService->cadastro($dadosFuncionario);
                return to_route('login')->with(
                    'bfm',
                    [
                        'tipo' => 'sucesso',
                        'titulo' => 'Cadastro concluído',
                        'notificacao' => 'Cadastro concluído com sucesso'
                    ]
                );
            }
        } catch (EmpresaException $ee) {
            return back()->with(
                'bfm',
                [
                    'tipo' => 'erro',
                    'titulo' => 'Cadastro da empresa',
                    'notificacao' => $ee->getMessage()
                ]
            );
        } catch (FuncionarioException $fe) {
            return back()->with(
                'bfm',
                [
                    'tipo' => 'erro',
                    'titulo' => 'Cadastro do dono',
                    'notificacao' => $fe->getMessage()
                ]
            );
        } catch (AutenticacaoException $ae) {
            return back()->with(
                'bfm',
                [
                    'tipo' => 'erro',
                    'titulo' => 'Cadastro da usuário',
                    'notificacao' => $ae->getMessage()
                ]
            );
        }
    }
}
