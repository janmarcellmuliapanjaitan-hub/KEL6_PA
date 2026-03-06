<?php
// app/Http/Controllers/Admin/TestimoniController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    // Menampilkan semua testimoni
    public function index()
    {
        $testimonis = Testimoni::orderBy('created_at', 'desc')->get();
        
        // Hitung jumlah testimoni menunggu
        $menunggu = Testimoni::where('status', false)->count();
        
        return view('admin.testimoni.index', compact('testimonis', 'menunggu'));
    }

    // Menyetujui testimoni
    public function approve($id)
    {
        $testimoni = Testimoni::find($id);
        $testimoni->status = true;
        $testimoni->save();

        return redirect()->back()->with('success', 'Testimoni disetujui dan ditampilkan.');
    }

    // Menghapus testimoni
    public function destroy($id)
    {
        $testimoni = Testimoni::find($id);
        $testimoni->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }
}