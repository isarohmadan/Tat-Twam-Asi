<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }
    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.login');
    }
    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => 'Password salah.']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return $user->is_admin
            ? redirect()->route('admin.dashboard')
            : redirect()->route('home');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/home');
    }

    // Proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'], // Perbaikan di sini - tambahkan Hash
            'is_admin' => false,
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
