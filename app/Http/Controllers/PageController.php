<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        $about = AboutUs::first();
        return view('guest.about.about', compact('about'));
    }

    public function menu()
    {
        $menus = \App\Models\Menu::all()->groupBy('category');
        return view('guest.menu.index', compact('menus'));
    }

    public function promo()
    {
        // Get valid promos or just latest promos
        $promos = \App\Models\Promo::latest()->get();
        return view('guest.promo.index', compact('promos'));
    }
}