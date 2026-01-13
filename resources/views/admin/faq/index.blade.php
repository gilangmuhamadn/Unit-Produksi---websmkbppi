@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 20px;
    }

    .d-flex {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: start;
    }

    .card {
        width: 18rem;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-body {
        padding: 15px;
        flex-grow: 1;
    }

    .card-title {
        font-size: 1rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #168AC7;
    }

    .card-text {
        font-size: 0.85rem;
        color: #333;
    }

    .card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #f9f9f9;
        border-top: 1px solid #eaeaea;
        padding: 10px 15px;
    }
</style>

<div class="container">
    <h2 class="text-center mb-4">Daftar FAQ</h2>

    <!-- Tombol Tambah FAQ (Hanya untuk Admin) -->
    @auth
        @if (auth()->user()->role === 'admin')
            <div class="mb-4 text-end">
                <a href="{{ route('admin.faq.create') }}" class="btn btn-success">+ Tambah FAQ</a>
            </div>
        @endif
    @endauth

    <div class="d-flex">
        @foreach ($faqs as $faq)
            <div class="card">
                <div class="card-body">
                    <!-- Pertanyaan FAQ -->
                    <h5 class="card-title">{{ $faq->question }}</h5>
                    
                    <!-- Jawaban FAQ -->
                    <p class="card-text">{{ Str::limit($faq->description, 100) }}</p>
                </div>

                <!-- Tombol Edit dan Hapus (Hanya untuk Admin) -->
                @auth
                    @if (auth()->user()->role === 'admin')
                        <div class="card-footer">
                            <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">Hapus</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>
</div>
@endsection
