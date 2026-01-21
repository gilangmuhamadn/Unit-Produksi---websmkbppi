@extends('layouts.app') {{-- kalau layout kamu namanya beda, ganti sesuai projectmu --}}

@section('content')
<div class="login-container py-5 text-center" style="margin-top: 120px;">
    <h2>Login Admin</h2>
    <p>Silakan klik tombol di bawah untuk masuk sebagai admin.</p>

    <a href="{{ route('login') }}" class="btn btn-primary">
        Login
    </a>
</div>
@endsection