<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    // Menampilkan form untuk meminta link reset password
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirimkan email dengan link reset password
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Kirimkan email reset password
        $status = Password::sendResetLink($request->only('email'));

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Menampilkan form untuk mereset password menggunakan token
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // Melakukan reset password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Melakukan reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill(['password' => ($request->password)])->save();
            }
        );

         return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status)) // Jika sukses, arahkan ke login
            : back()->withErrors(['email' => [__($status)]]); // Jika gagal, kembali dengan error
    }
}
