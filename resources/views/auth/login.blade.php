@extends('layouts.app')

@section('content')
<style>
    /* Styling Halaman Login */
body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
}

/* Container Utama */
.login-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

/* Logo */
.logo img {
    width: 150px;
    margin-bottom: 20px;
}

/* Kotak Login */
.login-box {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    width: 500px;
    text-align: center;
}

/* Judul */
.login-box h2 {
    margin-bottom: 20px;
    color: #333;
}

/* Form Group */
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

/* Tombol Login */
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

/* Link Kembali ke Home */
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
        <h2>Login Admin</h2>
        <form action="{{ route('login.submit') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        @error('password')
            <div style="color: red; font-size: 13px;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="login-button">Login</button>
</form>

        <div class="back-home">
            <a href="{{ route('home') }}">&larr; Back To Home</a>
        </div>
    </div>
</div>
@endsection
