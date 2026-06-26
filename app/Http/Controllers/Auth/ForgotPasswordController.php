<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function resetPasswordDirectly(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'name.required' => 'Nama lengkap (Username) harus diisi.',
            'password.required' => 'Password baru harus diisi.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // Verify if a user exists with both email and name (username)
        $user = User::where('email', $request->email)
                    ->where('name', $request->name)
                    ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput($request->only('email', 'name'))
                ->withErrors(['error' => 'Kombinasi Nama Lengkap dan Email tidak terdaftar dalam sistem.']);
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Redirect based on role to correct login form
        if ($user->role === 'admin') {
            return redirect()->route('login')->with('success', 'Password admin berhasil diperbarui, silakan login.');
        } else {
            return redirect()->route('guest.login.form')->with('success', 'Password pelanggan berhasil diperbarui, silakan login.');
        }
    }
}
