<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KrsController extends Controller
{
    // 1. Dashboard Utama Mahasiswa
    public function index()
    {
        $npmLogon = auth()->user()->username_kaitan ?? '';

        // Mengambil data mhs tetap sama
        $mhs = Mahasiswa::where('npm', $npmLogon)->first() ?? (object)[
            'nama_mahasiswa' => auth()->user()->name,
            'npm' => $npmLogon ?: 'NPM Tidak Terdeteksi'
        ];

        // Menggunakan Eloquent dengan Eager Loading untuk optimasi query
        $krsAktif = \App\Models\Krs::with(['matakuliah', 'jadwal.dosen'])
            ->where('npm', $npmLogon)
            ->get();

        return view('mahasiswa.dashboard', compact('mhs', 'krsAktif'));
    }

    // 2. Halaman Pemilihan KRS
    public function create()
    {
        $npmLogon = auth()->user()->username_kaitan ?? '';

        // Ambil semua jadwal yang tersedia beserta relasinya
        $pilihanJadwal = Jadwal::with(['matakuliah', 'dosen'])->get();

        // KUNCI: Ambil daftar kode_matakuliah yang sudah diambil oleh mahasiswa ini
        $krsTerpilih = DB::table('krs')->where('npm', $npmLogon)->pluck('kode_matakuliah')->toArray();

        return view('mahasiswa.pilih_krs', compact('pilihanJadwal', 'krsTerpilih'));
    }

    // 3. Proses Menyimpan KRS
    public function store(Request $request)
    {
        $npmLogon = auth()->user()->username_kaitan ?? '';
        $kodeMkBaru = $request->input('kode_matakuliah');

        // 1. Ambil SKS matakuliah yang ingin ditambah
        $sksBaru = DB::table('matakuliahs')->where('kode_matakuliah', $kodeMkBaru)->value('sks');

        // 2. Hitung total SKS yang sudah diambil saat ini
        $totalSksDiambil = DB::table('krs')
            ->join('matakuliahs', 'krs.kode_matakuliah', '=', 'matakuliahs.kode_matakuliah')
            ->where('krs.npm', $npmLogon)
            ->sum('matakuliahs.sks');

        // 3. Validasi: Maksimal 24 SKS
        if (($totalSksDiambil + $sksBaru) > 24) {
            return redirect()->back()->with('error', 'Gagal! Total SKS melebihi batas maksimal (24 SKS).');
        }

        // 4. Proses simpan seperti biasa
        $sudahAda = DB::table('krs')->where('npm', $npmLogon)->where('kode_matakuliah', $kodeMkBaru)->exists();

        if ($sudahAda) {
            return redirect()->back()->with('error', 'Mata kuliah ini sudah ada di dalam KRS kamu!');
        }

        DB::table('krs')->insert([
            'npm'             => $npmLogon,
            'kode_matakuliah' => $kodeMkBaru,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    // 4. Proses Membatalkan KRS
    public function destroy($kode_matakuliah)
    {
        $npmLogon = auth()->user()->username_kaitan;

        // Pastikan hanya data milik mahasiswa tersebut yang dihapus
        $deleted = DB::table('krs')
            ->where('npm', $npmLogon)
            ->where('kode_matakuliah', $kode_matakuliah)
            ->delete();

        // 3. Berikan umpan balik (Flash Message)
        if ($deleted) {
            return redirect()->route('mahasiswa.dashboard')->with('success', 'Mata kuliah berhasil dibatalkan.');
        }

        return redirect()->route('mahasiswa.dashboard')->with('error', 'Gagal membatalkan mata kuliah.');
    }
}
