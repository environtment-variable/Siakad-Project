<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nidn', 'nama'];

    // Relasi: Satu dosen bisa memiliki banyak mahasiswa wali
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'nidn', 'nidn');
    }

    // Relasi: Satu dosen bisa memiliki banyak jadwal mengajar
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'nidn', 'nidn');
    }
}
