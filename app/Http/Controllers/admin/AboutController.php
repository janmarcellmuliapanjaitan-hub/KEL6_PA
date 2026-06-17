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
                'title' => 'required',
                'description' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $data = [
                'title' => $request->title,
                'description' => $request->description
            ];

            if ($request->hasFile('image')) {
                $image = time().'.'.$request->image->extension();
                $request->image->move(public_path('uploads/about'), $image);
                $data['image'] = $image;
            }

            $data['user_id'] = auth()->id();
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description
        ];

        if ($request->hasFile('image')) {
            if ($about->image && file_exists(public_path('uploads/about/'.$about->image))) {
                unlink(public_path('uploads/about/'.$about->image));
            }
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/about'), $image);
            $data['image'] = $image;
        }

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $about = AboutUs::findOrFail($id);
        
        if ($about->image && file_exists(public_path('uploads/about/'.$about->image))) {
            unlink(public_path('uploads/about/'.$about->image));
        }
        
        $about->delete();
        
        return redirect()->route('admin.about.index')->with('success', 'Data berhasil dihapus');
    }
}