<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanPhoto extends Model
{
    use HasFactory;
    protected $table = 'jurusan_photos';
    protected $fillable = ['jurusan_id', 'photo'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    
   
}
