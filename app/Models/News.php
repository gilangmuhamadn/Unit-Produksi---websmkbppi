<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image'];
    public $timestamps = true; // Ini untuk mengaktifkan created_at dan updated_at otomatis
}


