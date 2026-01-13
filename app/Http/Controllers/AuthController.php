<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

   


public function authenticated(Request $request)
{
    $user = Auth::user();
    return redirect()->route('home')->with('success', 'Selamat datang, ' . $user->name . '!');
}


    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    // Tampilkan dashboard
    public function dashboard()
    {
        return view('dashboard');
    }
}
