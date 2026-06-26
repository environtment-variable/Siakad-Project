<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Panel Akademik Mahasiswa</title>
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
            margin-bottom: 20px;
        }

        .info-profil {
            background: #eff6ff;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #2563eb;
            margin-bottom: 20px;
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
            padding: 8px 14px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            display: inline-block;
        }

        .tombol-krs {
            background: #2563eb;
            margin-bottom: 15px;
        }

        .tombol-batal {
            background: #dc2626;
            padding: 5px 10px;
            font-size: 0.85rem;
        }

        .tombol-keluar {
            background: #475569;
            float: right;
        }

        .notif-sukses {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="kotak-utama">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="tombol tombol-keluar" style="cursor: pointer;">Keluar Aplikasi</button>
        </form>

        <h2>Dashboard Akademik Mahasiswa</h2>

        @if(session('success'))
        <div style="padding: 15px; background-color: #bff1ca; color: #03a429; border: 1px solid #126c27; border-radius: 5px; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div style="padding: 15px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
        @endif

        <div class="info-profil">
            <p><strong>Nama Lengkap:</strong> {{ $mhs->nama_mahasiswa ?? auth()->user()->name }}</p>
            <p><strong>NPM:</strong> {{ $mhs->npm ?? $mhs->username }}</p>
            <p><strong>Program Studi:</strong> Teknik Informatika</p>
        </div>

        <h3>Rencana Studi Kamu (KRS Aktual)</h3>
        <a href="{{ route('mahasiswa.pilih_krs') }}" class="tombol tombol-krs">+ Isi / Tambah Mata Kuliah</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Dosen Pengajar</th>
                    <th>Waktu & Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $totalSks = 0; @endphp
                @forelse($krsAktif as $key => $krs)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $krs->kode_matakuliah }}</td>
                    <td>{{ $krs->matakuliah->nama_matakuliah }}</td>
                    <td>{{ $krs->matakuliah->sks }} SKS</td>
                    <td>{{ $krs->jadwal->dosen->nama }}</td>
                    <td>{{ $krs->jadwal->hari }}, {{ $krs->jadwal->jam }} - Ruangan: {{ $krs->jadwal->ruangan }}</td>
                    <td>
                        <form action="{{ route('mahasiswa.batal_krs', $krs->kode_matakuliah) }}" method="POST" onsubmit="return confirm('Batalkan pengisian mata kuliah ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="tombol tombol-batal">Batalkan</button>
                        </form>
                    </td>
                </tr>
                @php $totalSks += $krs->matakuliah->sks; @endphp
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #64748b;">Kamu belum mengambil mata kuliah apa pun di semester ini.</td>
                </tr>
                @endforelse
            </tbody>
            @if($totalSks > 0)
            <tfoot style="border-top: 2px solid #e2e8f0;">
                <tr style="font-weight: bold; background: {{ $totalSks > 20 ? '#fee2e2' : '#f8fafc' }}; color: {{ $totalSks > 20 ? '#991b1b' : '#1e293b' }};">
                    <td colspan="3" style="text-align: right;">Total Beban SKS Diambil:</td>
                    <td colspan="4">
                        {{ $totalSks }} SKS
                        @if($totalSks > 20)
                        <small>(Hati-hati, sudah mendekati batas maksimal!)</small>
                        @endif
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

</body>

</html>