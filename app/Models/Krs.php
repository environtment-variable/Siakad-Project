<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'krs';
    protected $fillable = ['npm', 'kode_matakuliah'];

    // Menghubungkan ke Mahasiswa yang mengambil
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }

    // Menghubungkan ke Mata Kuliah yang diambil
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    // Definisikan hubungan ke Jadwal
    public function jadwal() {
        return $this->belongsTo(Jadwal::class, 'kode_matakuliah', 'kode_matakuliah');
    }
}
