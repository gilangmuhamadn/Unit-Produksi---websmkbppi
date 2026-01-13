@extends('layouts.app')

@section('title', 'Upload Berita')

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
</style>

<br>
<div class="form-container">
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Judul Berita:</label>
            <input type="text" name="title" id="title" required placeholder="Masukkan judul berita">
        </div>

      
        <div class="form-group">
            <label for="content">Isi Berita:</label>
            <textarea name="content" id="content"  placeholder="Tulis isi berita"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Unggah Foto Header:</label>
            <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
            <div class="image-preview" id="imagePreview">
                <img id="preview" src="" alt="Preview Foto" style="display: none;">
            </div>
        </div>

        <button type="submit" class="btn-submit">Simpan Berita</button>
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
