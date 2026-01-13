<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    

    public function index()
    {
        $galleries = Gallery::paginate(9); // Betul, gunakan paginate

        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Upload file ke public/storage/galleries
    $filename = time() . '_' . $request->file('image')->getClientOriginalName();
    $request->file('image')->move(public_path('storage/galleries'), $filename);

    Gallery::create([
        'name'  => $request->name,
        'image' => 'galleries/' . $filename,
    ]);

    return redirect()->route('admin.gallery.index')->with('success', 'Gambar berhasil ditambahkan');
}

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

public function update(Request $request, Gallery $gallery)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = ['name' => $request->name];

    if ($request->hasFile('image')) {
        // Hapus file lama jika ada
        if ($gallery->image && file_exists(public_path('storage/' . $gallery->image))) {
            unlink(public_path('storage/' . $gallery->image));
        }

        // Upload file baru
        $filename = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('storage/galleries'), $filename);

        $data['image'] = 'galleries/' . $filename;
    }

    $gallery->update($data);

    return redirect()->route('admin.gallery.index')->with('success', 'Gambar berhasil diperbarui');
}

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gambar berhasil dihapus');
    }
}


