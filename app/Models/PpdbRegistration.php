<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpdbRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'jurusan',
        'whatsapp',
        'asal_sekolah',
        'alamat_lengkap',
        'tahun_lulus',
    ];
}