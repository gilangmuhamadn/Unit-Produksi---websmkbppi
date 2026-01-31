<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class StaffController extends Controller
{

    public function index()
{
    $teachingStaffs = Staff::where('type', 'pengajar')->paginate(10);
    $tuStaffs       = Staff::where('type', 'tu')->paginate(10);

    // Kalau yang akses route admin (admin.staff.index), tampilkan view admin
    if (request()->routeIs('admin.*')) {
        return view('admin.tim_sekolah.index', compact('teachingStaffs', 'tuStaffs'));
    }

    // Kalau user biasa (tim_sekolah.index), tampilkan view user
    return view('tim_sekolah.index', compact('teachingStaffs', 'tuStaffs'));
}
    

    //public function index()
//{
    //$timSekolah = Staff::orderBy('id', 'desc')->get();
    //return view('tim_sekolah.index', compact('timSekolah'));
//}


    //public function index()
    //{
         //$staffs = Staff::all();
         //return view('admin.staff.index', compact('staffs'));
     //}
    
    public function create()
    {
        return view('admin.tim_sekolah.create');
    }
    
 public function store(Request $request)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'quote'      => 'required|string|max:500',
        'photo'      => 'required|image',
        'type'       => 'required|string',
    ]);

    // SIMPAN KE storage/app/public/staff_photos
    $path = $request->file('photo')->store('staff_photos', 'public'); // hasil: staff_photos/namafile.png

    Staff::create([
        'name'       => $request->name,
        'department' => $request->department,
        'quote'      => $request->quote,
        'photo'      => $path,   // SIMPAN PATH INI
        'type'       => $request->type,
    ]);

    return redirect()->route('admin.staff.index')->with('success', 'Data berhasil ditambahkan!');
}

    public function edit(Staff $staff)
    {
        return view('admin.tim_sekolah.edit', compact('staff'));
    }

  
public function update(Request $request, Staff $staff)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'quote'      => 'nullable|string|max:500',
        'photo'      => 'nullable|image',
        'type'       => 'nullable|string',
    ]);

    $data = [
        'name'       => $request->name,
        'department' => $request->department,
        'quote'      => $request->quote,
    ];

    if ($request->filled('type')) {
        $data['type'] = $request->type;
    }

    if ($request->hasFile('photo')) {
        // hapus foto lama dari storage public
        if ($staff->photo) {
            Storage::disk('public')->delete($staff->photo);
        }

        // simpan foto baru
        $data['photo'] = $request->file('photo')->store('staff_photos', 'public');
    }

    $staff->update($data);

    return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil diperbarui.');
}

    public function destroy(Staff $staff)
{
    if ($staff->photo) {
        Storage::disk('public')->delete($staff->photo);
    }

    $staff->delete();
    return redirect()->route('admin.staff.index')->with('success', 'Staff berhasil dihapus.');
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

