@extends('layouts.app')

@section('title', 'Edit Jurusan')

@section('content')
<style>
    :root {
        --maincolor: #ffffff;
        --secondarycolor: #168ac7;
        --thirdcolor: #ffcc00;
        --fontcolor: #252121;
        --anothercolor: #2c4964;
    }

    .form-container {
        max-width: 600px;
        margin: 50px auto;
        background-color: var(--maincolor);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-submit {
        background-color: var(--secondarycolor);
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
    }

    .image-preview img {
        max-width: 100px;
        max-height: 100px;
        object-fit: cover;
        margin-top: 10px;
        border-radius: 5px;
    }
</style>
<br>
<div class="form-container">
    <h2 class="text-center">Edit Jurusan</h2>
    <form action="{{ route('jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_jurusan">Nama Jurusan:</label>
            <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control" value="{{ $jurusan->nama_jurusan }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Jurusan:</label>
            <textarea name="deskripsi" id="content" class="form-control" required>{{ $jurusan->deskripsi }}</textarea>
        </div>

        <div class="form-group">
            <label for="logo_jurusan">Logo Jurusan:</label>
            <input type="file" name="logo_jurusan" id="logo_jurusan" class="form-control" accept="image/*" onchange="previewImage(event, 'logoPreview')">
            <div class="image-preview" id="logoPreview">
                @if($jurusan->logo_jurusan)
                    <img src="{{ asset('storage/' . $jurusan->logo_jurusan) }}" alt="Logo Jurusan">
                @endif
            </div>
        </div>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>
</div>

<script>
    function previewImage(event, previewId) {
        const preview = document.getElementById(previewId);
        preview.innerHTML = '';
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
