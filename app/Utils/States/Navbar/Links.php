<?php

namespace App\Utils\States\Navbar;

class Links {
    protected array $links = [
        [
            "url" => "/quem-somos",
            "nome" => "Quem somos"
        ],
        [
            "url" => "/contatos",
            "nome" => "Contatos"
        ],
        [
            "url" => "/cadastro",
            "nome" => "Crie sua conta"
        ],
        [
            "url" => "/login",
            "nome" => "Login"
        ],
    ];

    public function getLinks(): array {
        return $this->links;
    }
}
