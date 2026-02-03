<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data PPDB</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
        h3 { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; vertical-align: top; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Data Pendaftar PPDB</h3>

    <table>
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
            @foreach($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row->nama_lengkap }}</td>
                    <td>{{ $row->jurusan }}</td>
                    <td>{{ $row->whatsapp }}</td>
                    <td>{{ $row->asal_sekolah }}</td>
                    <td>{{ $row->alamat_lengkap }}</td>
                    <td>{{ $row->tahun_lulus }}</td>
                    <td>{{ $row->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>