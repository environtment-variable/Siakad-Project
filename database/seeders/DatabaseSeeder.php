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
    public function run(): void
    {
        // 1. Dosen (Gunakan updateOrInsert dengan NIDN sebagai kunci)
        Dosen::updateOrInsert(
            ['nidn' => '1111111111'],
            ['nama' => 'Dr. Aris Permana, M.T.']
        );

        // 2. Mahasiswa (Gunakan updateOrInsert dengan NPM sebagai kunci)
        Mahasiswa::updateOrInsert(
            ['npm' => '5520124054'],
            ['nidn' => '1111111111', 'nama' => 'MUHAMMAD RIZKYA NASTI FIRMANSYAH']
        );

        // 3. Users (Gunakan updateOrInsert dengan Email sebagai kunci)
        User::updateOrInsert(
            ['email' => 'admin@siakad.com'],
            [
                'name' => 'Admin SIAKAD',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'username_kaitan' => null,
            ]
        );

        User::updateOrInsert(
            ['email' => 'mahasiswa1@siakad.com'],
            [
                'name' => 'Muhammad Rizkya',
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
                'username_kaitan' => '5520124054',
            ]
        );

        User::updateOrInsert(
            ['email' => 'mahasiswa2@siakad.com'],
            [
                'name' => 'Muhammad Qory',
                'password' => Hash::make('password123'),
                'role' => 'mahasiswa',
                'username_kaitan' => '5520124055',
            ]
        );

        // 4. Matakuliah (Gunakan updateOrInsert dengan kode_matakuliah sebagai kunci)
        Matakuliah::updateOrInsert(
            ['kode_matakuliah' => 'IF53413'],
            ['nama_matakuliah' => 'Pemrograman Web II', 'sks' => 4]
        );

        Matakuliah::updateOrInsert(
            ['kode_matakuliah' => 'IF53414'],
            ['nama_matakuliah' => 'Basis Data Lanjut', 'sks' => 4]
        );

        Matakuliah::updateOrInsert(
            ['kode_matakuliah' => 'IF53415'],
            ['nama_matakuliah' => 'Jaringan Komputer', 'sks' => 3]
        );
    }
}
