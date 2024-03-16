<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $MenuService;


    public function __construct(MenuService $MenuService) {
        $this->MenuService = $MenuService;
    }

    public function index()
    {
        $menus = $this->MenuService->getMenus();
        return view('menus.index', compact('menus'));
    }
}
