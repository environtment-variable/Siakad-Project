<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Data Dosen Utama (untuk Dosen Wali & Pengajar)
        $dosen = Dosen::create([
            'nidn' => '1111111111',
            'nama' => 'Dr. Aris Permana, M.T.'
        ]);

        // 2. Seed Data Mahasiswa (Menggunakan data Anda)
        $mahasiswa = Mahasiswa::create([
            'npm' => '5520124054',
            'nidn' => '1111111111', // Wali ke dosen di atas
            'nama' => 'MUHAMMAD RIZKYA NASTI FIRMANSYAH'
        ]);

        // 3. Seed Akun Users untuk Autentikasi Login
        // Akun Admin
        User::create([
            'name' => 'Admin SIAKAD',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('password123'),
                     'role' => 'admin',
                     'username_kaitan' => null,
        ]);

        // Akun Mahasiswa (Terhubung dengan data mahasiswa Anda via username_kaitan)
        User::create([
            'name' => 'Muhammad Rizkya',
            'email' => 'mahasiswa@siakad.com',
            'password' => Hash::make('password123'),
                     'role' => 'mahasiswa',
                     'username_kaitan' => '5520124054', // Menyimpan NPM untuk relasi KRS nanti
        ]);

        // 4. Seed Data Mata Kuliah Contoh
        Matakuliah::create([
            'kode_matakuliah' => 'IF53413',
            'nama_matakuliah' => 'Pemrograman Web II',
            'sks' => 3
        ]);

        Matakuliah::create([
            'kode_matakuliah' => 'IF53414',
            'nama_matakuliah' => 'Basis Data Lanjut',
            'sks' => 4
        ]);

        Matakuliah::create([
            'kode_matakuliah' => 'IF53415',
            'nama_matakuliah' => 'Jaringan Komputer',
            'sks' => 3
        ]);
    }
}
