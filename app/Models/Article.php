<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Izinkan atribut ini untuk mass assignment
    protected $fillable = ['title', 'content', 'image'];

}
