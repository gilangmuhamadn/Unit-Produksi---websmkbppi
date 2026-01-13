<?php


namespace App\Http\Controllers;

use App\Models\EkskulPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkskulPhotoController extends Controller
{
    public function destroyPhoto(EkskulPhoto $photo)
{
    if ($photo) {
        // Hapus file dari storage
        Storage::disk('public')->delete($photo->photo);

        // Hapus hanya foto, bukan ekskul
        $photo->delete();
    }

    // Kembali ke halaman edit ekskul
    return back()->with('success', 'Foto kegiatan berhasil dihapus.');
}

public function destroy($id)
{
    $photo = Photo::findOrFail($id);

    if ($photo->photo && Storage::disk('public')->exists($photo->photo)) {
        Storage::disk('public')->delete($photo->photo);
    }

    $photo->delete();

    return redirect()->back()->with('success', 'Foto berhasil dihapus');
}



}

