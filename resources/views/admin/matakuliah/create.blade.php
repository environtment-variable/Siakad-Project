<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Data Baru</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background: #f3f4f6;
        }

        .kotak {
            background: white;
            padding: 20px;
            border-radius: 5px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .grup-input {
            margin-bottom: 15px;
        }

        .grup-input label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .grup-input input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .pesan-error {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .tombol-simpan {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="kotak">
        <a href="{{ route('admin.matakuliah.index') }}" style="text-decoration: none;">⬅ Kembali</a>
        <h2>Form Tambah Data</h2>

        <form action="{{ route('admin.matakuliah.store') }}" method="POST">
            @csrf

            <div class="grup-input">
                <label>Kode Utama</label>
                <input type="text" name="kode_matakuliah" value="{{ old('kode_matakuliah') }}">
                @error('kode_matakuliah')
                <div class="pesan-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="grup-input">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah') }}">
                @error('nama_matakuliah')
                <div class="pesan-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="grup-input">
                <label>Jumlah Bobot (SKS)</label>
                <input type="number" name="sks" value="{{ old('sks') }}">
                @error('sks')
                <div class="pesan-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="tombol-simpan">Simpan Data Baru</button>
        </form>
    </div>

</body>

</html>