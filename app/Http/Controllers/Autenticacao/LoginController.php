<?php

namespace App\Http\Controllers\Autenticacao;

use App\Http\Controllers\Controller;
use App\Utils\States\Navbar\Links;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class LoginController extends Controller {
    public function __construct(
        private readonly Links $links
    ){}

    public function index(): Response|ResponseFactory {
        return \inertia('Autenticacao/LoginView', [
            'links' => $this->links->getLinks()
        ]);
    }

    public function store(Request $request): RedirectResponse {
        Auth::attempt($request->only(['email', 'password']), $request->get('manterLogado'));
        return to_route('dashboard');
    }
}
