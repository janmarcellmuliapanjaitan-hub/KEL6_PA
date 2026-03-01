<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        return view('admin.about.index', compact('about'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ];

        if ($request->hasFile('gambar')) {
            $gambar = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('uploads/about'), $gambar);
            $data['gambar'] = $gambar;
        }

        AboutUs::create($data);

        return redirect()->route('admin.about.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $about = AboutUs::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = AboutUs::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ];

        if ($request->hasFile('gambar')) {
            if ($about->gambar && file_exists(public_path('uploads/about/'.$about->gambar))) {
                unlink(public_path('uploads/about/'.$about->gambar));
            }
            $gambar = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('uploads/about'), $gambar);
            $data['gambar'] = $gambar;
        }

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $about = AboutUs::findOrFail($id);
        
        if ($about->gambar && file_exists(public_path('uploads/about/'.$about->gambar))) {
            unlink(public_path('uploads/about/'.$about->gambar));
        }
        
        $about->delete();
        
        return redirect()->route('admin.about.index')->with('success', 'Data berhasil dihapus');
    }
}