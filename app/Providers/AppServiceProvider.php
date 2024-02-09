<?php

namespace App\Providers;

use App\Repositories\Repository\Eloquent\Usuario\UsuarioRepository;
use App\Repositories\Repository\Eloquent\Cliente\ClienteRepository;
use App\Repositories\Interfaces\Usuario\IUsuario;
use App\Repositories\Interfaces\Cliente\ICliente;
use App\Services\Autenticacao\CadastroService;
use App\Services\Cliente\ClienteService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(ClienteService::class, function(Application $app) {
            $clienteRepository = $app->make(ICliente::class);
            $cadastroService = $app->make(CadastroService::class);
            return new ClienteService($clienteRepository, $cadastroService);
        });
        $this->app->scoped(CadastroService::class, function(Application $app) {
            $usuarioRepository = $app->make(IUsuario::class);
            return new CadastroService($usuarioRepository);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ICliente::class, ClienteRepository::class);
        $this->app->bind(IUsuario::class, UsuarioRepository::class);
    }
}
