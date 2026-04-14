<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Testimoni;

class HomeController extends Controller
{
    public function index()
    {
        $menus = Menu::inRandomOrder()->limit(4)->get();
        $testimonis = Testimoni::where('status', true)->latest()->limit(3)->get();
        return view('home', compact('menus', 'testimonis'));
    }
}
