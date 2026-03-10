<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show admin registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Show guest registration form
     */
    public function showGuestRegistrationForm()
    {
        return view('auth.register-guest');
    }

    /**
     * Handle admin registration request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except('password', 'password_confirmation'));
        }

        // Create admin user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        Log::info('New admin registered: ' . $user->email);

        return redirect()->route('login')->with('success', 'Admin account created successfully! Silakan login dengan akun baru Anda.');
    }

    /**
     * Handle guest registration request
     */
    public function guestRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->except('password', 'password_confirmation'));
        }

        // Create guest/user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Log::info('New guest registered: ' . $user->email);

        return redirect()->route('guest.login.form')->with('success', 'Pendaftaran berhasil! Silakan login dengan akun Anda.');
    }
}
