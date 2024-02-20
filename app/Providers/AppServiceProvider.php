<?php

namespace App\Providers;

use App\Repositories\Interfaces\Estoque\Classe\IClasseProduto;
use App\Repositories\Interfaces\Estoque\Fabricante\IFabricanteProduto;
use App\Repositories\Repository\Eloquent\Estoque\Classe\ClasseProdutoRepository;
use App\Repositories\Repository\Eloquent\Estoque\Fabricante\FabricanteProdutoRepository;
use App\Repositories\Repository\Eloquent\Usuario\UsuarioRepository;
use App\Repositories\Repository\Eloquent\Cliente\ClienteRepository;
use App\Repositories\Interfaces\Usuario\IUsuario;
use App\Repositories\Interfaces\Cliente\ICliente;
use App\Repositories\Interfaces\Empresa\IEmpresa;
use App\Repositories\Interfaces\Funcionario\IFuncionario;
use App\Repositories\Repository\Eloquent\Empresa\EmpresaRepository;
use App\Repositories\Repository\Eloquent\Funcionario\FuncionarioRepository;
use App\Services\Autenticacao\CadastroService;
use App\Services\Cliente\ClienteService;
use App\Services\Empresa\EmpresaService;
use App\Services\Estoque\Classe\ClasseProdutoService;
use App\Services\Estoque\Fabricante\FabricanteProdutoService;
use App\Services\Funcionario\FuncionarioService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->scoped(ClienteService::class, function (Application $app) {
      $clienteRepository = $app->make(ICliente::class);
      $cadastroService = $app->make(CadastroService::class);
      return new ClienteService($clienteRepository, $cadastroService);
    });
    $this->app->scoped(CadastroService::class, function (Application $app) {
      $usuarioRepository = $app->make(IUsuario::class);
      return new CadastroService($usuarioRepository);
    });
    $this->app->scoped(EmpresaService::class, function (Application $app) {
      $empresaRepository = $app->make(IEmpresa::class);
      return new EmpresaService($empresaRepository);
    });
    $this->app->scoped(FuncionarioService::class, function (Application $app) {
      $funcionarioRepository = $app->make(IFuncionario::class);
      $cadastroService = $app->make(CadastroService::class);
      $empresaService = $app->make(EmpresaService::class);
      return new FuncionarioService($funcionarioRepository, $cadastroService, $empresaService);
    });
    $this->app->scoped(ClasseProdutoService::class, function (Application $app) {
      $classeProdutoRepository = $app->make(IClasseProduto::class);
      $empresaService = $app->make(EmpresaService::class);
      return new ClasseProdutoService($classeProdutoRepository, $empresaService);
    });
    $this->app->scoped(FabricanteProdutoService::class, function (Application $app) {
      $fabricanteProdutoRepository = $app->make(IFabricanteProduto::class);
      $empresaService = $app->make(EmpresaService::class);
      return new FabricanteProdutoService($fabricanteProdutoRepository, $empresaService);
    });
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    $this->app->bind(ICliente::class, ClienteRepository::class);
    $this->app->bind(IUsuario::class, UsuarioRepository::class);
    $this->app->bind(IEmpresa::class, EmpresaRepository::class);
    $this->app->bind(IFuncionario::class, FuncionarioRepository::class);
    $this->app->bind(IClasseProduto::class, ClasseProdutoRepository::class);
    $this->app->bind(IFabricanteProduto::class, FabricanteProdutoRepository::class);
  }
}
