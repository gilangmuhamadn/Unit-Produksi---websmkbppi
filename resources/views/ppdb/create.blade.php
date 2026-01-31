@extends('layouts.app')

@section('title', 'Pendaftaran PPDB')

@section('content')
<style>
  /* bikin dropdown jurusan normal */
  select, 
  select.form-control {
    height: 42px !important;   /* atau 40px */
    padding: 10px !important;
    line-height: 1.2 !important;
  }

  /* kalau ada yang bikin select tinggi banget, paksa override */
  select {
    min-height: 42px !important;
  }

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
    textarea:focus,
    select:focus {
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

    .form-title {
        font-weight: bold;
        color: var(--anothercolor);
        margin-bottom: 15px;
        font-size: 20px;
        text-align: center;
    }

    /* biar enak di HP */
    @media (max-width: 768px){
        .form-container{
            width: 92%;
        }
    }
</style>

<br>

<div class="form-container">
    <div class="form-title">Form Pendaftaran PPDB</div>

    {{-- Kalau mau tampilkan error validasi --}}
    @if ($errors->any())
        <div style="background:#f8d7da; color:#842029; padding:10px; border-radius:6px; margin-bottom:15px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ppdb.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap"
                   value="{{ old('nama_lengkap') }}"
                   required placeholder="Masukkan nama lengkap">
        </div>

        <div class="form-group">
            <label for="jurusan">Jurusan:</label>
            <select name="jurusan" id="jurusan" required>
                <option value="">-- Pilih Jurusan --</option>
                <option value="PPLG" {{ old('jurusan')=='PPLG' ? 'selected' : '' }}>PPLG</option>
                <option value="TJKT" {{ old('jurusan')=='TJKT' ? 'selected' : '' }}>TJKT</option>
                <option value="AKL"  {{ old('jurusan')=='AKL' ? 'selected' : '' }}>AKL</option>
                <option value="ACP"  {{ old('jurusan')=='ACP' ? 'selected' : '' }}>ACP</option>
            </select>
        </div>

        <div class="form-group">
            <label for="whatsapp">No Telp / Whatsapp:</label>
            <input type="text" name="whatsapp" id="whatsapp"
                   value="{{ old('whatsapp') }}"
                   required placeholder="Contoh: 08xxxxxxxxxx">
        </div>

        <div class="form-group">
            <label for="asal_sekolah">Asal Sekolah:</label>
            <input type="text" name="asal_sekolah" id="asal_sekolah"
                   value="{{ old('asal_sekolah') }}"
                   required placeholder="Masukkan asal sekolah">
        </div>

        <div class="form-group">
            <label for="alamat_lengkap">Alamat Lengkap:</label>
            <textarea name="alamat_lengkap" id="alamat_lengkap" required
                      placeholder="Masukkan alamat lengkap">{{ old('alamat_lengkap') }}</textarea>
        </div>

        <div class="form-group">
            <label for="tahun_lulus">Tahun Lulus:</label>
            <input type="text" name="tahun_lulus" id="tahun_lulus"
                   value="{{ old('tahun_lulus') }}"
                   required placeholder="Contoh: 2024">
        </div>

        <button type="submit" class="btn-submit">Kirim Pendaftaran</button>
    </form>
</div>
@endsection