<?php

namespace App\Http\Controllers\Autenticacao;

use App\Http\Controllers\Controller;
use App\Utils\States\Navbar\Links;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class LoginController extends Controller {
    public function __construct(
        private readonly Links $links
    ){}

    public function login(): Response|ResponseFactory {
        return \inertia('Autenticacao/LoginView', [
            'links' => $this->links->getLinks()
        ]);
    }
}
