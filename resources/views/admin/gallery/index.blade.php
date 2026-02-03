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
        justify-content: center;
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
        text-align: center;
    }

    .card-title {
        font-size: 1rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #168AC7;
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
    <h2 class="text-center mb-4">Gallery</h2>

    @auth
        @if (auth()->user()->role === 'admin')
            <div class="mb-4 text-end">
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-success">+ Tambah Gambar</a>
            </div>
        @endif
    @endauth

    <div class="d-flex">
        @foreach ($galleries as $gallery)
            <div class="card">
                <img src="{{ asset('storage/' . $gallery->image) }}" class="card-img-top" alt="{{ $gallery->name }}">

                <div class="card-body">
                    <h5 class="card-title">{{ $gallery->name }}</h5>
                </div>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <div class="card-footer">
                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $gallery->id }}" data-title="{{ $gallery->name }}">Hapus</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $galleries->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                let form = this.closest("form");
                let itemTitle = this.getAttribute("data-title");

                Swal.fire({
                    title: "Hapus " + itemTitle + "?",
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
