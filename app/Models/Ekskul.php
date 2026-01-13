<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    use HasFactory;
    protected $table = 'ekskuls';
    protected $fillable = ['logo', 'nama', 'deskripsi'];

    public function photos()
    {
        return $this->hasMany(EkskulPhoto::class,'ekskul_id');
    }
    public function ekskulphotos()
    {
        return $this->hasMany(EkskulPhoto::class,'ekskul_id');
    }
}
