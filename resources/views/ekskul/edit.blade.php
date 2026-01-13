@extends('layouts.app')

@section('title', 'Edit Ekskul')

@section('content')
<style>
    :root {
        --maincolor: #ffffff;
        --secondarycolor: #168ac7;
        --thirdcolor: #ffcc00;
        --fontcolor: #252121;
        --anothercolor: #2c4964;
    }

    body {
        background-color: var(--maincolor);
        color: var(--fontcolor);
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .form-container {
        width: 50%;
        margin: 30px auto;
        background-color: var(--maincolor);
        padding: 20px;
        border: 1px solid var(--anothercolor);
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        color: var(--anothercolor);
        margin-bottom: 5px;
    }

    input[type="text"],
    textarea,
    input[type="file"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid var(--secondarycolor);
        border-radius: 4px;
        background-color: var(--maincolor);
        color: var(--fontcolor);
    }

    textarea {
        resize: none;
        height: 150px;
    }

    input:focus,
    textarea:focus {
        border-color: var(--thirdcolor);
        outline: none;
    }

    .btn-submit {
        background-color: var(--secondarycolor);
        color: var(--maincolor);
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-submit:hover {
        background-color: var(--thirdcolor);
        color: var(--fontcolor);
        transition: 0.3s;
    }

    .image-preview {
        margin-top: 15px;
        text-align: center;
        padding: 10px;
        border: 1px dashed var(--secondarycolor);
        border-radius: 8px;
        background-color: #f9f9f9;
        max-width: 200px;
        margin-left: auto;
        margin-right: auto;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        object-fit: cover;
    }

    .old-photos {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .old-photos div {
        position: relative;
    }

    .old-photos img {
        max-width: 100px;
        border-radius: 8px;
        object-fit: cover;
        height: 80px;
    }

    .delete-photo {
        position: absolute;
        top: 5px;
        right: 5px;
        background: red;
        color: white;
        border: none;
        padding: 5px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }

    .delete-photo:hover {
        background: darkred;
    }
</style>

<br>
<div class="form-container">
    <h1>Edit Ekskul</h1>
    <form action="{{ route('admin.ekskul.update', ['id' => $ekskul->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Ekskul:</label>
            <input type="text" name="nama" id="nama" value="{{ $ekskul->nama }}" required placeholder="Masukkan nama ekskul">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Ekskul:</label>
            <textarea name="deskripsi" id="content" required placeholder="Tulis deskripsi ekskul">{{ $ekskul->deskripsi }}</textarea>
        </div>

        <div class="form-group">
            <label for="logo">Logo Ekskul:</label>
            <input type="file" name="logo" id="logo" accept="image/*" onchange="previewLogo(event)">
            <div class="image-preview" id="logoPreview">
                @if($ekskul->logo)
                    <img id="logoImage" src="{{ asset('storage/' . $ekskul->logo) }}" alt="Logo Ekskul">
                @else
                    <img id="logoImage" src="" alt="Preview Logo" style="display: none;">
                @endif
            </div>
        </div>

      
     

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>
</div>

<script>
    function previewLogo(event) {
        const preview = document.getElementById('logoImage');
        const logoPreview = document.getElementById('logoPreview');

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }

    function previewKegiatan(event) {
        const previewContainer = document.getElementById('photosPreview');
        previewContainer.innerHTML = ''; // Clear previous previews

        const files = event.target.files;
        if (files.length > 0) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                const img = document.createElement('img');
                img.style.maxWidth = '100px';
                img.style.margin = '5px';
                img.style.borderRadius = '8px';
                img.style.objectFit = 'cover';
                img.style.height = '80px';

                reader.onload = function(e) {
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);

                previewContainer.appendChild(img);
            });
        }
    }
</script>
@endsection
