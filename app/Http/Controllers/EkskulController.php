<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Article;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkskulController extends Controller
{
    public function index()
    {
        $ekskuls = Ekskul::with('photos')->paginate(10); 

        return view('ekskul.index', compact('ekskuls'));
        
    }

    public function create()
    {
        return view('ekskul.create');
    }

    public function show($id)
{
    $ekskul = Ekskul::findOrFail($id);
    $latestArticles = Article::latest()->take(5)->get();
    $latestNews = News::latest()->take(5)->get();

    return view('ekskul.show', [
        'ekskuls' => $ekskul,
        'latestArticles' => $latestArticles,
        'latestNews' => $latestNews,
    ]);
}


public function store(Request $request)
{
    $request->validate([
        'logo'      => 'required|image',
        'nama'      => 'required|string|max:255',
        'deskripsi' => 'required',
        'photos.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Upload logo ekskul
    $filename = time() . '_' . $request->file('logo')->getClientOriginalName();
    $request->file('logo')->move(public_path('storage/ekskul_logos'), $filename);

    $ekskul = Ekskul::create([
        'logo'      => 'ekskul_logos/' . $filename,
        'nama'      => $request->nama,
        'deskripsi' => $request->deskripsi,
    ]);

    // Upload foto kegiatan (jika ada)
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/ekskul_photos'), $photoName);

            $ekskul->photos()->create([
                'photo' => 'ekskul_photos/' . $photoName,
            ]);
        }
    }

    return redirect()->route('ekskul.index')->with('success', 'Ekskul berhasil ditambahkan.');
}

    public function edit($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        return view('ekskul.edit', compact('ekskul'));
    }

   
public function update(Request $request, $id)
{
    $ekskul = Ekskul::findOrFail($id);

    $request->validate([
        'nama'      => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'logo'      => 'nullable|image',
        'photos.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update data dasar
    $ekskul->update([
        'nama'      => $request->nama,
        'deskripsi' => $request->deskripsi,
    ]);

    // Kalau ada logo baru
    if ($request->hasFile('logo')) {
        // Hapus logo lama kalau ada
        if ($ekskul->logo && file_exists(public_path('storage/' . $ekskul->logo))) {
            unlink(public_path('storage/' . $ekskul->logo));
        }

        // Upload logo baru
        $filename = time() . '_' . $request->file('logo')->getClientOriginalName();
        $request->file('logo')->move(public_path('storage/ekskul_logos'), $filename);

        $ekskul->update(['logo' => 'ekskul_logos/' . $filename]);
    }

    // Upload foto kegiatan baru (jika ada)
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/ekskul_photos'), $photoName);

            $ekskul->photos()->create([
                'photo' => 'ekskul_photos/' . $photoName,
            ]);
        }
    }

    return redirect()->route('admin.ekskul.index')->with('success', 'Data ekskul berhasil diperbarui');
}

    public function destroy($id)
    {
        // Cari ekskul berdasarkan ID
        $ekskul = Ekskul::findOrFail($id);
    
        // Hapus logo ekskul dari storage jika ada
        if ($ekskul->logo) {
            Storage::delete($ekskul->logo);
        }
    
    
        // Hapus data ekskul dari database
        $ekskul->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('ekskul.index')->with('success', 'Ekskul berhasil dihapus.');
    }

   

    
}
