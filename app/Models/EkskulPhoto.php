<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkskulPhoto extends Model
{
    use HasFactory;
    protected $table = 'ekskul_photos';
    protected $fillable = ['ekskul_id', 'photo'];

   
    
}
