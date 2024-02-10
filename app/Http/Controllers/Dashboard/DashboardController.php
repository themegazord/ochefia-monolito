<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use App\Utils\States\Navbar\LinksSistema;

class DashboardController extends Controller
{
  public function __construct(
    private readonly LinksSistema $linksSistema
  ) {}
  public function index(): Response|ResponseFactory
  {
    return inertia('Dashboard/DashboardView', [
      'menus' => $this->linksSistema->getMenus(),
      'subMenus' => $this->linksSistema->getSubMenus()
    ]);
  }
}
