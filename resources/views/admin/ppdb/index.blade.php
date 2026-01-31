@extends('layouts.app')

@section('title', 'Data PPDB')

@section('content')
<div class="container" style="margin-top:30px;">
    <h3>Data Pendaftar PPDB</h3>

    <div style="overflow-x:auto;">
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Jurusan</th>
                    <th>Whatsapp</th>
                    <th>Asal Sekolah</th>
                    <th>Alamat Lengkap</th>
                    <th>Tahun Lulus</th>
                    <th>Waktu Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $row)
                    <tr>
                        <td>{{ $data->firstItem() + $i }}</td>
                        <td>{{ $row->nama_lengkap }}</td>
                        <td>{{ $row->jurusan }}</td>
                        <td>{{ $row->whatsapp }}</td>
                        <td>{{ $row->asal_sekolah }}</td>
                        <td>{{ $row->alamat_lengkap }}</td>
                        <td>{{ $row->tahun_lulus }}</td>
                        <td>{{ $row->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;">Belum ada pendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $data->links() }}
    </div>
</div>
@endsection