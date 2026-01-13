@extends('layouts.app')

@section('title', 'Tambah Testimoni')

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
    input[type="number"],
    textarea,
    input[type="file"] {
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
</style>

<br>
<div class="form-container">
    <h2 class="text-center">Tambah Testimoni Alumni</h2>
    <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="graduation_year">Tahun Lulus:</label>
            <input type="number" name="graduation_year" id="graduation_year" required>
        </div>

        <div class="form-group">
            <label for="testimonial">Testimoni:</label>
            <textarea name="testimonial" id="testimonial" required></textarea>
        </div>

        <div class="form-group">
            <label for="photo">Upload Foto:</label>
            <input type="file" name="photo" id="photo" accept="image/*" required onchange="previewImage(event)">
        </div>

        <div class="form-group">
            <div class="image-preview" id="imagePreview">
                <p>Preview Gambar Akan Muncul di Sini</p>
                <img id="preview" style="display: none;">
            </div>
        </div>

        <button type="submit" class="btn-submit">Simpan</button>
    </form>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const imagePreview = document.getElementById('imagePreview');

        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                imagePreview.style.border = '1px solid #ccc';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
@endsection
