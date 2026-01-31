@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 40px;
    }

    .staff-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .staff-card {
        display: flex;
        align-items: flex-start;
        background-color: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        height: 300px;
        position: relative;
    }

    .staff-card:hover {
        transform: scale(1.02);
    }

    .staff-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 4px solid #ddd;
        cursor: pointer;
        transition: border-color 0.3s;
    }

    .staff-photo:hover {
        border-color: #168ac7;
    }

    .staff-info {
        flex-grow: 1;
    }

    .staff-name {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .staff-position {
        font-size: 0.9rem;
        color: #007bff;
        margin-bottom: 8px;
    }

    .staff-quote {
        font-style: italic;
        color: #666;
        font-size: 0.85rem;
        border-left: 4px solid #007bff;
        padding-left: 10px;
        margin-top: 5px;
    }

    .action-buttons {
        margin-top: 10px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .modal-content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    .modal-content img {
        width: 70%;
        max-width: 700px;
        border-radius: 10px;
    }

    .close {
        position: absolute;
        top: 20px;
        right: 35px;
        color: white;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: red;
    }
</style>

<div class="container">
    <h1 class="title">Staff Pengajar</h1>
    @auth
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary mb-3">Tambah Staff Pengajar</a>
    @endauth
    <div class="staff-grid">
        @foreach($teachingStaffs as $staff)
        <div class="staff-card">
            <img src="{{ asset('storage/' . $staff->photo) }}" alt="{{ $staff->name }}" class="staff-photo" onclick="showModal(this)">
            <div class="staff-info">
                <h2 class="staff-name">{{ $staff->name }}</h2>
                <p class="staff-position">{{ $staff->position }}</p>
                <blockquote class="staff-quote">"{{ $staff->quote }}"</blockquote>
                @auth
                    <div class="action-buttons">
    <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
    <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
    </form>
</div>

                @endauth
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tambahan untuk Staff TU -->
    <h1 class="title" style="margin-top: 50px;">Tim Sekolah</h1>
    @auth
        <a href="{{ route('admin.staff.create') }}" class="btn btn-primary mb-3">Tambah Tim Sekolah</a>
    @endauth
    <div class="staff-grid">
        @foreach($tuStaffs as $staff)
        <div class="staff-card">
            <img src="{{ asset('storage/' . $staff->photo) }}" alt="{{ $staff->name }}" class="staff-photo" onclick="showModal(this)">
            <div class="staff-info">
                <h2 class="staff-name">{{ $staff->name }}</h2>
                <p class="staff-position">{{ $staff->position }}</p>
                <blockquote class="staff-quote">"{{ $staff->quote }}"</blockquote>
                @auth
                    <div class="action-buttons">
                        <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
</div>


<!-- Modal untuk menampilkan foto besar -->
<div id="photoModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <img id="modalImg" src="">
    </div>
</div>

<script>
    function showModal(element) {
        var modal = document.getElementById("photoModal");
        var modalImg = document.getElementById("modalImg");
        modal.style.display = "block";
        modalImg.src = element.src;
    }

    function closeModal() {
        document.getElementById("photoModal").style.display = "none";
    }
</script>



@endsection
