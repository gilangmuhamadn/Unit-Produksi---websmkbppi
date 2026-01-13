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

    .card-img-top {
        width: 100%;
        height: 180px;
        object-fit: cover;
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
    <h2 class="text-center mb-4">Testimoni Alumni</h2>

    @auth
        @if (auth()->user()->role === 'admin')
            <div class="mb-4 text-end">
                <a href="{{ route('testimonial.create') }}" class="btn btn-success">+ Tambah Testimoni</a>
            </div>
        @endif
    @endauth

    <div class="d-flex">
        @foreach ($testimonials as $testimonial)
            <div class="card">
                @if ($testimonial->photo)
                    <img src="{{ asset('storage/' . $testimonial->photo) }}" class="card-img-top" alt="{{ $testimonial->name }}">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $testimonial->name }}</h5>
                    <p class="card-text"><strong>Tahun Lulus:</strong> {{ $testimonial->graduation_year }}</p>
                    <p class="card-text">{{ Str::limit($testimonial->testimonial, 100) }}</p>
                </div>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <div class="card-footer">
                            <a href="{{ route('testimonial.edit', $testimonial->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('testimonial.destroy', $testimonial->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>

   
</div>
@endsection
