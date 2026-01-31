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
  
    @media (max-width: 768px) {
    .staff-grid {
        grid-template-columns: 1fr; /* Jadi 1 kolom di layar kecil */
    }

    .staff-card {
        flex-direction: column;
        align-items: center;
        text-align: center;
        height: auto;
    }

    .staff-photo {
        margin-right: 0;
        margin-bottom: 15px;
    }

    .staff-info {
        width: 100%;
    }
}


</style>

<div class="container">
    <h1 class="title">Staff Pengajar</h1>
    @auth
    <div class="mb-4 text-end">
        <a href="{{ route('admin.staff.create') }}" class="btn btn-success ">Tambah Staff</a>
    </div>
    @endauth
    <div class="staff-grid">
        @foreach($teachingStaffs as $staff)
        <div class="staff-card">
        <img src="{{ asset('storage/' . $staff->photo) }}" alt="{{ $staff->name }}" class="staff-photo" onclick="openModal('{{ asset('storage/' . $staff->photo) }}')">
            <div class="staff-info">
                <h2 class="staff-name">{{ $staff->name }}</h2>
                <p class="staff-position">{{ $staff->department }}</p>
                <blockquote class="staff-quote">"{{ $staff->quote }}"</blockquote>
                @auth
                    <div class="action-buttons">
                        <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" class="delete-form">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $staff->id }}" data-name="{{ $staff->name }}">Hapus</button>
</form>

                    </div>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Tambahan untuk Staff TU -->
    <h1 class="title" style="margin-top: 50px;">Tim Sekolah</h1>
    <div class="staff-grid">
        @foreach($tuStaffs as $staff)
        <div class="staff-card">
            <img src="{{ asset('storage/' . $staff->photo) }}" alt="{{ $staff->name }}" class="staff-photo" onclick="openModal('{{ asset('storage/' . $staff->photo) }}')">
          
            <div class="staff-info">
                <h2 class="staff-name">{{ $staff->name }}</h2>
                <p class="staff-position">{{ $staff->position }}</p>
                <blockquote class="staff-quote">"{{ $staff->quote }}"</blockquote>
                @auth
                    <div class="action-buttons">
                        <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.staff.destroy', $staff->id) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $staff->id }}" data-name="{{ $staff->name }}">Hapus</button>
</form>

                    </div>
                    @endauth
                </div>
            </div>
            @endforeach
    </div>
    </div>
    
</div>

<!-- Modal Gambar -->
<div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-transparent border-0 shadow-none">
      <div class="modal-body p-0 d-flex justify-content-center">
        <img id="modalImage" src="" alt="Foto Kegiatan" style="width: 100%; max-width: 700px; border-radius: 8px;">
      </div>
    </div>
  </div>
</div>

<script>
function openModal(photoUrl) {
    const modalImage = document.getElementById('modalImage');
    modalImage.src = photoUrl;

    const photoModal = new bootstrap.Modal(document.getElementById('photoModal'));
    photoModal.show();
}

// Tambahkan event untuk menutup modal saat area luar diklik
document.addEventListener("DOMContentLoaded", function() {
    const modalElement = document.getElementById("photoModal");

    modalElement.addEventListener("click", function(event) {
        if (event.target === modalElement) {
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                let form = this.closest("form");
                let staffName = this.getAttribute("data-name");

                Swal.fire({
                    title: "Hapus " + staffName + "?",
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
