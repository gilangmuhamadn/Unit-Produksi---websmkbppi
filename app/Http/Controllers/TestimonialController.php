<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonial.create');
    }

 public function store(Request $request)
{
    $request->validate([
        'name'            => 'required|string|max:255',
        'graduation_year' => 'required|digits:4',
        'testimonial'     => 'required|string',
        'photo'           => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Upload foto ke public/storage/testimonials
    $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
    $request->file('photo')->move(public_path('storage/testimonials'), $filename);

    Testimonial::create([
        'name'            => $request->name,
        'graduation_year' => $request->graduation_year,
        'testimonial'     => $request->testimonial,
        'photo'           => 'testimonials/' . $filename,
    ]);

    return redirect()->route('admin.testimonial.index')->with('success', 'Testimoni berhasil ditambahkan.');
}

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    
public function update(Request $request, Testimonial $testimonial)
{
    $request->validate([
        'name'            => 'required|string|max:255',
        'graduation_year' => 'required|digits:4',
        'testimonial'     => 'required|string',
        'photo'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = [
        'name'            => $request->name,
        'graduation_year' => $request->graduation_year,
        'testimonial'     => $request->testimonial,
    ];

    if ($request->hasFile('photo')) {
        // Hapus file lama jika ada
        if ($testimonial->photo && file_exists(public_path('storage/' . $testimonial->photo))) {
            unlink(public_path('storage/' . $testimonial->photo));
        }

        // Upload file baru
        $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('storage/testimonials'), $filename);

        $data['photo'] = 'testimonials/' . $filename;
    }

    $testimonial->update($data);

    return redirect()->route('admin.testimonial.index')->with('success', 'Testimoni berhasil diperbarui.');
}

    public function destroy(Testimonial $testimonial)
    {
        Storage::disk('public')->delete($testimonial->photo);
        $testimonial->delete();
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
