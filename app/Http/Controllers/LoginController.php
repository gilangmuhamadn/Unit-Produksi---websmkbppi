<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Akun tidak terdaftar'])->withInput();
        }

        // Coba login
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/dashboard'); // ubah ke tujuanmu
        }

        return back()->withErrors(['password' => 'Password salah'])->withInput();
    }

    public function authenticated(Request $request)
    {
        return redirect()->route('home');
    }
}
