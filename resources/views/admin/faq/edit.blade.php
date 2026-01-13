@extends('layouts.app')

@section('title', 'Edit FAQ')

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
    textarea {
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
</style>

<br>
<br>
<h2 class="text-center">Edit FAQ</h2>
<div class="form-container">
    <form action="{{ route('admin.faq.update', $faq) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="question">Pertanyaan:</label>
            <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea name="description" id="description" required>{{ old('description', $faq->description) }}</textarea>
        </div>

        <button type="submit" class="btn-submit">Simpan Perubahan</button>
    </form>
</div>
@endsection
