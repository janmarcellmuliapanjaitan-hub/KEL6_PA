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
        
        // Hitung jumlah testimoni menunggu (status false = pending)
        $menunggu = Testimoni::where('status', false)->count();
        
        return view('admin.testimoni.index', compact('testimonis', 'menunggu'));
    }

    // Menyetujui testimoni
    public function approve($id)
    {
        try {
            $testimoni = Testimoni::findOrFail($id);
            
            if ($testimoni->status) {
                return redirect()->back()->with('info', 'Testimoni sudah disetujui sebelumnya.');
            }
            
            $testimoni->status = true;
            $testimoni->save();

            return redirect()->back()->with('success', 'Testimoni berhasil disetujui dan ditampilkan.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Menghapus testimoni
    public function destroy($id)
    {
        try {
            $testimoni = Testimoni::findOrFail($id);
            $testimoni->delete();

            return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}