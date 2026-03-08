<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

use App\Models\Category;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil semua kategori aktif beserta menu aktifnya
        $kategori = Category::aktif()
                            ->with(['menus' => function ($query) {
                                $query->where('is_active', true)
                                      ->orderBy('urutan');
                            }])
                            ->get();

        $whatsappNumber = config('app.whatsapp_number', '6281234567890');
        return view('guest.menu.index', compact('kategori', 'whatsappNumber'));
    }
}
