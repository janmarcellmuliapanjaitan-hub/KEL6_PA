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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'review' => 'required|min:1'
        ]);

        // Simpan ke database
        Testimoni::create([
            'name' => $request->name,
            'email' => $request->email,
            'review' => $request->review,
            'status' => false, // status false karena butuh persetujuan admin
            'user_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Testimoni Anda Telah Diterima!');
    }
}