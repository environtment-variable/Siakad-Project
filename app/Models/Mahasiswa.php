<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['npm', 'nidn', 'nama'];

    // Relasi: Mahasiswa memiliki satu Dosen Wali
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    // Relasi: Mahasiswa memiliki banyak data di tabel KRS
    public function krs()
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }
}
