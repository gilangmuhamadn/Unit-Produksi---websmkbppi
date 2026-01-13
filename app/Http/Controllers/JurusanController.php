<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Article;
use App\Models\News;
use App\Models\JurusanPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusanList = Jurusan::all();
        
        return view('jurusan.index', compact('jurusanList'));
    }

  public function show($id)
{
    $jurusan = Jurusan::findOrFail($id);
    $latestArticles = Article::latest()->take(5)->get();
    $latestNews = News::latest()->take(5)->get();

    return view('jurusan.show', [
        'jurusan' => $jurusan,
        'latestArticles' => $latestArticles,
        'latestNews' => $latestNews,
    ]);
}


    public function create()
    {
        return view('jurusan.create');
    }


    public function store(Request $request)
    {
     $request->validate([
    'nama_jurusan'   => 'required|string|max:255',
    'deskripsi'      => 'required',
    'logo_jurusan'   => 'required|image',
    'photos.*'       => 'image|mimes:jpeg,png,jpg|max:2048' 
]);


$logoName = time() . '_' . $request->file('logo_jurusan')->getClientOriginalName();


$request->file('logo_jurusan')->move(public_path('storage/jurusan_logos'), $logoName);


$logoPath = 'jurusan_logos/' . $logoName;


$jurusan = Jurusan::create([
    'nama_jurusan'  => $request->nama_jurusan,
    'deskripsi'     => $request->deskripsi,
    'logo_jurusan'  => $logoPath
]);


if ($request->hasFile('photos')) {
    foreach ($request->file('photos') as $photo) {
        $photoName = time() . '_' . $photo->getClientOriginalName();
        $photo->move(public_path('storage/jurusan_photos'), $photoName);

        
        $jurusan->photos()->create([
            'path' => 'jurusan_photos/' . $photoName
        ]);
    }
}

        // Simpan foto kegiatan jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Simpan foto dan ambil path-nya
                $path = $photo->store('jurusan_photos', 'public');
        
                // Simpan ke dalam database
                $jurusan->jurusanphotos()->create([
                    'photo' => $path // Pastikan kolom sesuai dengan database
                ]);
            }
        }
        
        
        
    
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }


    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
{
    $request->validate([
        'nama_jurusan' => 'required|string|max:255',
        'deskripsi'    => 'required|string',
        'logo_jurusan' => 'nullable|image',
        'photos.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update data jurusan (tanpa logo & foto dulu)
    $jurusan->update([
        'nama_jurusan' => $request->nama_jurusan,
        'deskripsi'    => $request->deskripsi,
    ]);

    // Update logo jurusan
    if ($request->hasFile('logo_jurusan')) {
        // Hapus logo lama kalau ada
        if ($jurusan->logo_jurusan && file_exists(public_path('storage/' . $jurusan->logo_jurusan))) {
            unlink(public_path('storage/' . $jurusan->logo_jurusan));
        }

        // Upload logo baru
        $filename = time() . '_' . $request->file('logo_jurusan')->getClientOriginalName();
        $request->file('logo_jurusan')->move(public_path('storage/jurusan_logos'), $filename);

        $jurusan->update(['logo_jurusan' => 'jurusan_logos/' . $filename]);
    }

    // Upload foto kegiatan baru
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/jurusan_photos'), $filename);

            JurusanPhoto::create([
                'jurusan_id' => $jurusan->id,
                'photo'      => 'jurusan_photos/' . $filename,
            ]);
        }
    }

    return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui!');
}

    

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}

