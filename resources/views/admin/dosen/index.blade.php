<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Dosen</title>
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
        <h2>Daftar Dosen</h2>

        @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.dosen.create') }}" class="btn btn-add">+ Tambah Dosen</a>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIDN</th>
                    <th>Nama Dosen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosens as $index => $dosen)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dosen->nidn }}</td>
                    <td>{{ $dosen->nama }}</td>
                    <td>
                        <a href="{{ route('admin.dosen.edit', $dosen->nidn) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('admin.dosen.destroy', $dosen->nidn) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus dosen ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada data dosen.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>