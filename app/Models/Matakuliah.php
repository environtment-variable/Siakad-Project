<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliahs';
    protected $primaryKey = 'kode_matakuliah';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_matakuliah', 'nama_matakuliah', 'sks'];

    // Relasi: Satu matakuliah bisa masuk ke banyak jadwal
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    // Relasi: Satu matakuliah bisa diambil di banyak KRS mahasiswa
    public function krs()
    {
        return $this->hasMany(Krs::class, 'kode_matakuliah', 'kode_matakuliah');
    }
}
