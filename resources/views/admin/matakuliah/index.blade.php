<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Mata Kuliah</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background: #f3f4f6;
        }

        .container {
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

        .btn {
            padding: 6px 12px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
        }

        .btn-add {
            background: #16a34a;
            display: inline-block;
            margin-bottom: 15px;
        }

        .btn-edit {
            background: #ea580c;
            margin-right: 5px;
        }

        .btn-delete {
            background: #dc2626;
        }

        .alert {
            background: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">⬅ Back to Dashboard</a>
        <h2>Daftar Mata Kuliah</h2>

        @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.matakuliah.create') }}" class="btn btn-add">+ Tambah Mata Kuliah</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matakuliahs as $index => $mk)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mk->kode_matakuliah }}</td>
                    <td>{{ $mk->nama_matakuliah }}</td>
                    <td>{{ $mk->sks }} SKS</td>
                    <td>
                        <a href="{{ route('admin.matakuliah.edit', $mk->kode_matakuliah) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada data mata kuliah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>