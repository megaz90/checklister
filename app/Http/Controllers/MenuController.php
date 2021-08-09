<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenuData()
    {
        $menu = (new MenuService())->menuData();
        return response()->json($menu);
    }
}
