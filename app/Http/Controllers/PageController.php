<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }
    
    public function about()
    {
        $about = AboutUs::first(); // Ambil data pertama
        return view('guest.about.about', compact('about'));
    }
    
    public function menu()
    {
        return view('menu');
    }
    
    public function testimoni()
    {
        return view('testimoni');
    }
    
    public function kontak()
    {
        return view('kontak');
    }
}