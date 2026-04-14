<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        // Get valid promos or just latest promos
        $promos = Promo::latest()->get();
        return view('guest.promo.index', compact('promos'));
    }
}
