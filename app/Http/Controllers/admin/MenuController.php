<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;

class MenuController extends Controller
{
    // ─── DASHBOARD ───────────────────────────────────────────
    public function dashboard()
    {
        $totalMenu       = Menu::count();
        $totalKategori   = Category::count();
        $totalAktif      = Menu::where('is_active', true)->count();
        $totalNonAktif   = Menu::where('is_active', false)->count();
        $kategori        = Category::withCount('semuaMenu')->orderBy('urutan')->get();

        return view('admin.dashboard', compact(
            'totalMenu', 'totalKategori', 'totalAktif', 'totalNonAktif', 'kategori'
        ));
    }

    // ─── LIST MENU ───────────────────────────────────────────
    public function index(Request $request)
    {
        $query = Menu::with('category');

        // Filter by kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'aktif');
        }

        // Search by nama / kode
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('kode', 'like', '%' . $request->search . '%');
            });
        }

        $menus      = $query->orderBy('category_id')->orderBy('urutan')->paginate(10)->withQueryString();
        $kategori   = Category::orderBy('urutan')->get();

        return view('admin.menu.index', compact('menus', 'kategori'));
    }

    // ─── FORM TAMBAH ─────────────────────────────────────────
    public function create()
    {
        $kategori = Category::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.menu.create', compact('kategori'));
    }

    // ─── SIMPAN MENU BARU ────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'kode'        => 'required|unique:menus,kode|max:10',
            'nama'        => 'required|max:100',
            'deskripsi'   => 'nullable|max:500',
            'harga'       => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'badge'       => 'nullable|max:30',
            'urutan'      => 'nullable|integer|min:0',
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'kode.required'        => 'Kode menu wajib diisi.',
            'kode.unique'          => 'Kode menu sudah digunakan.',
            'nama.required'        => 'Nama menu wajib diisi.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.integer'        => 'Harga harus berupa angka.',
            'gambar.image'         => 'File harus berupa gambar.',
            'gambar.max'           => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->except('gambar');
        $data['is_active'] = $request->boolean('is_active', true);
        $data['urutan']    = $request->urutan ?? 0;

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        Menu::create($data);

        return redirect()->route('admin.menu.index')
                         ->with('success', 'Menu "' . $data['nama'] . '" berhasil ditambahkan!');
    }

    // ─── FORM EDIT ───────────────────────────────────────────
    public function edit(Menu $menu)
    {
        $kategori = Category::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.menu.edit', compact('menu', 'kategori'));
    }

    // ─── UPDATE MENU ─────────────────────────────────────────
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'kode'        => 'required|max:10|unique:menus,kode,' . $menu->id,
            'nama'        => 'required|max:100',
            'deskripsi'   => 'nullable|max:500',
            'harga'       => 'required|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'badge'       => 'nullable|max:30',
            'urutan'      => 'nullable|integer|min:0',
        ]);

        $data = $request->except('gambar');
        $data['is_active'] = $request->boolean('is_active');
        $data['urutan']    = $request->urutan ?? 0;

        // Upload gambar baru, hapus yang lama
        if ($request->hasFile('gambar')) {
            if ($menu->gambar && !str_starts_with($menu->gambar, 'http')) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')
                         ->with('success', 'Menu "' . $menu->nama . '" berhasil diupdate!');
    }

    // ─── HAPUS MENU ──────────────────────────────────────────
    public function destroy(Menu $menu)
    {
        // Hapus gambar dari storage jika bukan URL eksternal
        if ($menu->gambar && !str_starts_with($menu->gambar, 'http')) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $nama = $menu->nama;
        $menu->delete();

        return redirect()->route('admin.menu.index')
                         ->with('success', 'Menu "' . $nama . '" berhasil dihapus!');
    }

    // ─── TOGGLE AKTIF / NONAKTIF ─────────────────────────────
    public function toggleStatus(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);

        $status = $menu->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', 'Menu "' . $menu->nama . '" berhasil ' . $status . '!');
    }

    // ─── KATEGORI : LIST ─────────────────────────────────────
    public function kategoriIndex()
    {
        $kategori = Category::withCount('semuaMenu')->orderBy('urutan')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    // ─── KATEGORI : SIMPAN ───────────────────────────────────
    public function kategoriStore(Request $request)
    {
        $request->validate([
            'name'   => 'required|max:50|unique:categories,name',
            'icon'   => 'nullable|max:10',
            'urutan' => 'nullable|integer|min:0',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique'   => 'Nama kategori sudah ada.',
        ]);

        Category::create([
            'name'      => $request->name,
            'icon'      => $request->icon,
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('success', 'Kategori "' . $request->name . '" berhasil ditambahkan!');
    }

    // ─── KATEGORI : UPDATE ───────────────────────────────────
    public function kategoriUpdate(Request $request, Category $category)
    {
        $request->validate([
            'name'   => 'required|max:50|unique:categories,name,' . $category->id,
            'icon'   => 'nullable|max:10',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $category->update([
            'name'      => $request->name,
            'icon'      => $request->icon,
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Kategori "' . $category->name . '" berhasil diupdate!');
    }

    // ─── KATEGORI : HAPUS ────────────────────────────────────
    public function kategoriDestroy(Category $category)
    {
        // Cek apakah masih ada menu di kategori ini
        if ($category->semuaMenu()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki menu!');
        }

        $nama = $category->name;
        $category->delete();

        return back()->with('success', 'Kategori "' . $nama . '" berhasil dihapus!');
    }
}
