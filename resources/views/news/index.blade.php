@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Menggunakan Bootstrap Grid yang benar */
    .row-cols-md-3 {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .col {
        flex: 1 1 calc(33.333% - 20px); /* 3 kolom per baris */
        min-width: 300px;
    }

    .card {
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

    .card-title a {
        text-decoration: none;
        color: #168AC7;
    }

    .card-title a:hover {
        color: #0b5e8a;
    }

    .card-text {
        font-size: 0.85rem;
        color: #333;
    }

    .btn-primary {
        background-color: #168AC7;
        border: none;
        font-size: 0.85rem;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0b5e8a;
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
    <h2 class="text-center mb-4">Berita Terbaru</h2>

    @auth
        @if (auth()->user()->role === 'admin')
            <div class="mb-4 text-end">
                <a href="{{ route('admin.news.create') }}" class="btn btn-success">+ Tambah Berita</a>
            </div>
        @endif
    @endauth

    <div class="row">
        @foreach ($news as $item)
            <div class="col-md-4 mb-4">
                <div class="card news-card h-100">
                    @if ($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('news.show', $item->id) }}" class="news-link">{{ $item->title }}</a>
                        </h5>
                        <p class="card-text">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                    </div>

                    @auth
                        @if (auth()->user()->role === 'admin')
                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">Hapus</button>

                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginasi -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $news->links() }}
    </div>
</div>
<script>
function confirmDelete(newsId) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Berita yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            // Kirim form untuk menghapus berita
            document.getElementById(`delete-form-${newsId}`).submit();
        }
    });
}
</script>

@endsection
