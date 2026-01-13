<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class StaffController extends Controller
{

    public function index()
    {
        // Paginasi untuk staff pengajar dan staff TU
        $teachingStaffs = Staff::where('type', 'pengajar')->paginate(10);
        $tuStaffs = Staff::where('type', 'tu')->paginate(10);
        
    
        return view('staff.index', compact('teachingStaffs', 'tuStaffs'));
    }
    

    // public function index()
    // {
    //     $staffs = Staff::all();
    //     return view('admin.staff.index', compact('staffs'));
    // }
    
    public function create()
    {
        return view('admin.staff.create');
    }
    
   public function store(Request $request)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'quote'      => 'required|string|max:500',
        'photo'      => 'required|image',
        'type'       => 'required|string|in:pengajar,tu',
    ]);

    // Upload foto staff
    $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
    $request->file('photo')->move(public_path('storage/staff_photos'), $filename);

    Staff::create([
        'name'       => $request->name,
        'department' => $request->department,
        'quote'      => $request->quote,
        'photo'      => 'staff_photos/' . $filename,
        'type'       => $request->type,
    ]);

    return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan!');
}

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

  
public function update(Request $request, Staff $staff)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'quote'      => 'nullable|string|max:500',
        'photo'      => 'nullable|image',
        'type'       => 'nullable|string|in:pengajar,tu',
    ]);

    // Data dasar
    $data = [
        'name'       => $request->name,
        'department' => $request->department,
        'quote'      => $request->quote,
    ];

    // Update type jika ada
    if ($request->has('type')) {
        $data['type'] = $request->type;
    }

    // Kalau ada foto baru
    if ($request->hasFile('photo')) {
        // Hapus foto lama kalau ada
        if ($staff->photo && file_exists(public_path('storage/' . $staff->photo))) {
            unlink(public_path('storage/' . $staff->photo));
        }

        // Upload foto baru
        $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path('storage/staff_photos'), $filename);

        $data['photo'] = 'staff_photos/' . $filename;
    }

    $staff->update($data);

    return redirect()->route('staff.index')->with('success', 'Staff berhasil diperbarui.');
}

    public function destroy(Staff $staff)
    {
        if ($staff->image) {
            Storage::disk('public')->delete($staff->image);
        }

        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff berhasil dihapus.');
    }
    
    public function pengajar()
    {
        $staffPengajar = Staff::where('type', 'pengajar')->get();
        return view('staff.pengajar', compact('staffPengajar'));
    }
    
    public function tu()
    {
        $staffTU = Staff::where('type', 'tu')->get();
        return view('staff.tu', compact('staffTU'));
    }
}

