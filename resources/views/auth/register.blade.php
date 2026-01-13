@extends('layouts.app')

@section('content')
<style>
/* GUNAKAN style login-mu */
body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
}
.login-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}
.logo img {
    width: 150px;
    margin-bottom: 20px;
}
.login-box {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 500px;
    text-align: center;
}
.login-box h2 {
    margin-bottom: 20px;
    color: #333;
}
.form-group {
    text-align: left;
    margin-bottom: 15px;
}
.form-group label {
    display: block;
    font-size: 14px;
    color: #555;
}
.form-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}
.login-button {
    width: 100%;
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}
.login-button:hover {
    background-color: #0056b3;
}
.back-home {
    margin-top: 15px;
}
.back-home a {
    text-decoration: none;
    color: #007bff;
    font-size: 14px;
}
.back-home a:hover {
    text-decoration: underline;
}
</style>

<div class="login-container">
    
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('img/bppigif.gif') }}" alt="SMK BPPI Baleendah">
        </a>
    </div>

    <div class="login-box">
        <h2>Register Admin Baru</h2>

        @if(session('success'))
            <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" required>
                @error('name') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" required>
                @error('email') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password') <small style="color: red;">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="login-button">Daftarkan Admin</button>
        </form>

        <div class="back-home">
            <a href="{{ route('home') }}">&larr; Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
