<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show guest login form
     */
    public function showGuestLoginForm()
    {
        return view('auth.login-guest');
    }

    /**
     * Handle admin login request - only allows admin account
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if email belongs to admin
        $admin = User::where('email', $request->email)->where('role', 'admin')->first();
        
        if (!$admin) {
            Log::warning('Non-admin user attempted to login: ' . $request->email);
            return back()->withErrors([
                'email' => 'Anda tidak memiliki akses ke panel admin.',
            ])->withInput($request->except('password'));
        }

        // Attempt to login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();
            
            // Double check if user is admin
            if ($user->role === 'admin') {
                Log::info('Admin logged in: ' . $user->email);
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Selamat datang, ' . $user->name . '!');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda tidak memiliki akses ke panel admin.',
                ])->withInput($request->except('password'));
            }
        }

        Log::warning('Failed login attempt for email: ' . $request->email);
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->except('password'));
    }

    /**
     * Handle guest login request
     */
    public function guestLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Only allow 'user' role for guest login
            if ($user->role !== 'user') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun ini bukan akun pelanggan.',
                ])->withInput($request->except('password'));
            }
            
            $request->session()->regenerate();
            Log::info('Guest logged in: ' . $user->email);
            return redirect()->intended(route('home'))->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        Log::warning('Failed guest login attempt for email: ' . $request->email);
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->except('password'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            Log::info('User logged out: ' . $user->email);
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
