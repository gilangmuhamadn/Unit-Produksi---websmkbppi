<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    // USER: form
    public function create()
    {
        return view('ppdb.create');
    }

    // USER: simpan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'jurusan'        => 'required|string|max:255',
            'whatsapp'       => 'required|string|max:50',
            'asal_sekolah'   => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'tahun_lulus'    => 'required|string|max:10',
        ]);

        PpdbRegistration::create($validated);

        return redirect()->back()->with('success', 'Pendaftaran PPDB berhasil dikirim!');
    }

    // ADMIN: list data
    public function index()
    {
        $data = PpdbRegistration::latest()->paginate(10);
        return view('admin.ppdb.index', compact('data'));
    }
}