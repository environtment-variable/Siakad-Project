<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Menampilkan semua jadwal kuliah
    public function index()
    {
        // Menggunakan eager loading (with) agar tidak boros query ke database
        $jadwals = Jadwal::with(['dosen', 'matakuliah'])->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    // Menampilkan form tambah jadwal
    public function create()
    {
        $dosens = Dosen::all();
        $matakuliahs = Matakuliah::all();
        return view('admin.jadwal.create', compact('dosens', 'matakuliahs'));
    }

    // Menyimpan data jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliahs,kode_matakuliah',
            'nidn'            => 'required|exists:dosens,nidn',
            'hari'            => 'required|string',
            'jam'             => 'required|string',
            'ruangan'         => 'required|string|max:10',
            'kelas'           => 'required',
        ], [
            'kode_matakuliah.required' => 'Mata kuliah wajib dipilih.',
            'nidn.required'            => 'Dosen pengajar wajib dipilih.',
            'hari.required'            => 'Hari perkuliahan wajib diisi.',
            'jam.required'             => 'Jam perkuliahan wajib diisi.',
            'ruangan.required'         => 'Ruangan wajib diisi.',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal kuliah berhasil ditambahkan!');
    }

    // Menampilkan form edit jadwal
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $dosens = Dosen::all();
        $matakuliahs = Matakuliah::all();
        return view('admin.jadwal.edit', compact('jadwal', 'dosens', 'matakuliahs'));
    }

    // Memperbarui data jadwal
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliahs,kode_matakuliah',
            'nidn'            => 'required|exists:dosens,nidn',
            'hari'            => 'required|string',
            'jam'             => 'required|string',
            'ruangan'         => 'required|string|max:10',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal kuliah berhasil diperbarui!');
    }

    // Menghapus data jadwal
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal kuliah berhasil dihapus!');
    }
}
