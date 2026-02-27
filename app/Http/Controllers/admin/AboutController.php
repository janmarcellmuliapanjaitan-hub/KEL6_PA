<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Menampilkan form edit about us (biasanya hanya 1 data)
     */
    public function index()
    {
        $about = AboutUs::first();
        return view('admin.about.index', compact('about'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Menyimpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $gambar = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('uploads/about'), $gambar);
            $data['gambar'] = $gambar;
        }

        AboutUs::create($data);

        return redirect()->route('admin.about.index')
                         ->with('success', 'Data about us berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $about = AboutUs::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Mengupdate data
     */
    public function update(Request $request, $id)
    {
        $about = AboutUs::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($about->gambar && file_exists(public_path('uploads/about/'.$about->gambar))) {
                unlink(public_path('uploads/about/'.$about->gambar));
            }

            $gambar = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('uploads/about'), $gambar);
            $data['gambar'] = $gambar;
        }

        $about->update($data);

        return redirect()->route('admin.about.index')
                         ->with('success', 'Data about us berhasil diupdate');
    }

    /**
     * Menghapus data
     */
    public function destroy($id)
    {
        $about = AboutUs::findOrFail($id);

        if ($about->gambar && file_exists(public_path('uploads/about/'.$about->gambar))) {
            unlink(public_path('uploads/about/'.$about->gambar));
        }

        $about->delete();

        return redirect()->route('admin.about.index')
                         ->with('success', 'Data about us berhasil dihapus');
    }
}