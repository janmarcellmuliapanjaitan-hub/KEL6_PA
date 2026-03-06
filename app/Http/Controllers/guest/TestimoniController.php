<?php


namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    // Menampilkan form testimoni dan daftar testimoni
    public function index()
    {
        // Ambil testimoni yang sudah disetujui (status = true)
        $testimonis = Testimoni::where('status', true)
                               ->orderBy('created_at', 'desc')
                               ->get();
        
    return view('guest.testimoni.index', compact('testimonis'));
    }

    // Menyimpan testimoni baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'ulasan' => 'required|min:1'
        ]);

        // Simpan ke database
        Testimoni::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'ulasan' => $request->ulasan,
            'status' => false // status false karena butuh persetujuan admin
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Testimoni Anda akan ditampilkan setelah disetujui admin.');
    }
}