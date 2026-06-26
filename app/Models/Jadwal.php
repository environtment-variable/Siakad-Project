<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    // primaryKey default-nya adalah 'id' (integer), jadi tidak perlu ditulis ulang jika menggunakan $table->id() di migrasi

    protected $fillable = [
        'kode_matakuliah',
        'nidn',
        'kelas',
        'hari',
        'jam',
        'ruangan'
    ];

    // Menghubungkan ke Mata Kuliah
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    // Menghubungkan ke Dosen Pengajar
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }
}
