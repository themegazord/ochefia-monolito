<?php

namespace App\Utils\States\Navbar;

class LinksSistema
{
  protected array $menus = [
    [
      'url' => '/dashboard',
      'label' => 'Dashboard',
      'icon' => 'fas fa-tachometer-alt',
      'subitens' => null
    ],
    [
      'url' => '/clientes',
      'label' => 'Clientes',
      'icon' => 'fas fa-users',
      'subitens' => null
    ],
    [
      'url' => '/caixa',
      'label' => 'Caixa',
      'icon' => 'fas fa-chart-line',
      'subitens' => null
    ],
    [
      'url' => '/pedidos',
      'label' => 'Pedidos',
      'icon' => 'fas fa-shopping-cart',
      'subitens' => null
    ],
    [
      'url' => '/relatorios',
      'label' => 'Relatorios',
      'icon' => 'fas fa-file',
      'subitens' => null
    ],
    [
      'url' => '/empresa',
      'label' => 'Empresa',
      'icon' => 'fas fa-cog',
      'subitens' => null
    ]
  ];

  protected array $subMenus = [
    [
      'label' => 'Estoque',
      'icon' => 'fas fa-cubes',
      'subitens' => [
        'produtos' => [
          'url' => '/estoque/produto/listagem',
          'label' => 'Produtos',
          'icon' => ''
        ],
        'grupo' => [
          'url' => '/estoque/grupo/listagem',
          'label' => 'Grupo',
          'icon' => ''
        ],
        'subGrupo' => [
          'url' => '/estoque/subgrupo/listagem',
          'label' => 'Sub Grupo',
          'icon' => ''
        ],
        'fornecedor' => [
          'url' => '/estoque/fabricante/listagem',
          'label' => 'Fabricantes',
          'icon' => ''
        ],
        'classe' => [
          'url' => '/estoque/classe/listagem',
          'label' => 'Classes',
          'icon' => ''
        ],
        'unidades' => [
          'url' => '/estoque/unidade/listagem',
          'label' => 'Unidade de medida',
          'icon' => ''
        ]
      ]
    ],
    [
      'label' => 'Financeiro',
      'icon' => 'fas fa-dollar-sign',
      'subitens' => [
        'contasAPagar' => [
          'url' => '/financeiro/pagar',
          'label' => 'Contas a pagar',
          'icon' => ''
        ],
        'contasAReceber' => [
          'url' => '/financeiro/receber',
          'label' => 'Contas a receber',
          'icon' => ''
        ],
        'formasPgto' => [
          'url' => '/financeiro/formapgto',
          'label' => 'Formas de Pagamento',
          'icon' => ''
        ],
        'prazoPgto' => [
          'url' => '/financeiro/prazopgto/listagem',
          'label' => 'Prazo de Pagamento',
          'icon' => ''
        ]
      ]
    ]
  ];

  public function getMenus(): array {
    return $this->menus;
  }

  public function getSubMenus(): array {
    return $this->subMenus;
  }
}