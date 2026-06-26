<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $adminWa = Setting::get('admin_whatsapp', env('ADMIN_WA'));
        return view('admin.settings.index', compact('adminWa'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'admin_whatsapp' => 'required|regex:/^[0-9]{8,15}$/'
        ], [
            'admin_whatsapp.required' => 'Nomor WhatsApp Admin harus diisi.',
            'admin_whatsapp.regex' => 'Nomor WhatsApp hanya boleh berisi angka dengan panjang 8 hingga 15 digit.'
        ]);

        Setting::set('admin_whatsapp', $request->admin_whatsapp);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
