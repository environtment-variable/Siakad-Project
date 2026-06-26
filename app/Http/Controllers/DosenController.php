<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    // Tampilkan Semua Data Dosen
    public function index()
    {
        $dosens = Dosen::all();
        return view('admin.dosen.index', compact('dosens'));
    }

    // Tampilkan Form Tambah Dosen
    public function create()
    {
        return view('admin.dosen.create');
    }

    // Simpan Data Dosen Baru (Ber-Validasi)
    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|size:10|unique:dosens,nidn',
            'nama' => 'required|string|max:50',
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.size' => 'NIDN harus tepat 10 karakter.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
            'nama.required' => 'Nama dosen wajib diisi.',
            'nama.max' => 'Nama dosen maksimal 50 karakter.',
        ]);

        Dosen::create($request->all());

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil ditambahkan!');
    }

    // Tampilkan Form Edit Dosen
    public function edit($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        return view('admin.dosen.edit', compact('dosen'));
    }

    // Update Data Dosen (Ber-Validasi)
    public function update(Request $request, $nidn)
    {
        $dosen = Dosen::findOrFail($nidn);

        $request->validate([
            'nama' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama dosen wajib diisi.',
            'nama.max' => 'Nama dosen maksimal 50 karakter.',
        ]);

        $dosen->update($request->only('nama'));

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil diubah!');
    }

    // Hapus Data Dosen
    public function destroy($nidn)
    {
        $dosen = Dosen::findOrFail($nidn);
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Data Dosen berhasil dihapus!');
    }
}
