<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Informasi Jadwal</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background: #f3f4f6;
        }

        .kontainer {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #cbd5e1;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f1f5f9;
        }

        .tombol {
            padding: 6px 12px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
        }

        .tombol-tambah {
            background: #16a34a;
            display: inline-block;
            margin-bottom: 15px;
        }

        .tombol-ubah {
            background: #ea580c;
            margin-right: 5px;
        }

        .tombol-hapus {
            background: #dc2626;
        }

        .notif {
            background: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="kontainer">
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">⬅ Kembali ke Dashboard</a>
        <h2>Daftar Jadwal Kuliah Aktual</h2>

        @if(session('success'))
        <div class="notif">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.jadwal.create') }}" class="tombol tombol-tambah">+ Tambah Jadwal Baru</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen Pengajar</th>
                    <th>Hari</th>
                    <th>Waktu / Jam</th>
                    <th>Ruangan</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $index => $jd)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>({{ $jd->matakuliah->kode_matakuliah }}) {{ $jd->matakuliah->nama_matakuliah }}</td>
                    <td>{{ $jd->dosen?->nama ?? 'Belum ada Dosen' }}</td>
                    <td>{{ $jd->hari }}</td>
                    <td>{{ $jd->jam }}</td>
                    <td>{{ $jd->ruangan }}</td>
                    <td>{{ $jd->kelas }}</td>
                    <td>
                        <a href="{{ route('admin.jadwal.edit', $jd->id) }}" class="tombol tombol-ubah">Edit</a>
                        <form action="{{ route('admin.jadwal.destroy', $jd->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="tombol tombol-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada data jadwal kuliah yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>