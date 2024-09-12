<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['kode_kelas', 'nama_kelas'];

    // Relasi ke User (siswa-siswa dalam kelas ini)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
