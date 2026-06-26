<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lembar Pemilihan Kelas KRS</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background: #f3f4f6;
        }

        .kotak-utama {
            background: white;
            padding: 20px;
            border-radius: 6px;
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
            font-size: 0.85rem;
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .tombol-kembali {
            background: #64748b;
            margin-bottom: 15px;
        }

        .tombol-ambil {
            background: #16a34a;
        }

        .status-diambil {
            color: #16a34a;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .notif-gagal {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="kotak-utama">
        <a href="{{ route('mahasiswa.dashboard') }}" class="tombol tombol-kembali">⬅ Kembali ke Dashboard</a>
        <h2>Lembar Pilihan Jadwal Kuliah Tersedia</h2>
        <p>Silakan klik tombol "Ambil" pada kelas mata kuliah yang ingin dimasukkan ke dalam rencana studi kamu.</p>

        @if(session('error'))
        <div class="notif-gagal">{{ session('error') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Dosen Pengajar</th>
                    <th>Hari & Jam</th>
                    <th>Ruangan</th>
                    <th>Opsi Penambahan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pilihanJadwal as $key => $jadwal)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $jadwal->matakuliah->kode_matakuliah }}</td>
                    <td>{{ $jadwal->matakuliah->nama_matakuliah }}</td>
                    <td>{{ $jadwal->matakuliah->sks }} SKS</td>
                    <td>{{ $jadwal->dosen->nama_dosen }}</td>
                    <td>{{ $jadwal->hari }}, {{ $jadwal->jam }}</td>
                    <td>{{ $jadwal->ruangan }}</td>
                    <td>
                        @if(in_array($jadwal->matakuliah->kode_matakuliah, $krsTerpilih))
                        <span class="status-diambil">✓ Sudah Terpilih</span>
                        @else
                        <form action="{{ route('mahasiswa.simpan_krs') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kode_matakuliah" value="{{ $jadwal->matakuliah->kode_matakuliah }}">
                            <button type="submit" class="tombol tombol-ambil">Ambil Kelas</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; color: #64748b;">Belum ada jadwal kuliah yang dibuka oleh admin untuk saat ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>