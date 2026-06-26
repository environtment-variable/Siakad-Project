<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ubah Data Aktual</title>
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

        .grup-input input[readonly] {
            background: #e2e8f0;
            cursor: not-allowed;
        }

        .pesan-error {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .tombol-update {
            background: #ea580c;
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
        <h2>Form Ubah Data</h2>

        <form action="{{ route('admin.matakuliah.update', $matakuliah->kode_matakuliah) }}" method="POST">
            @csrf
            @method('PUT') <div class="grup-input">
                <label>Kode Utama (Tidak Dapat Diubah)</label>
                <input type="text" name="kode_matakuliah" value="{{ $matakuliah->kode_matakuliah }}" readonly>
            </div>

            <div class="grup-input">
                <label>Nama Lengkap Baru</label>
                <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}">
                @error('nama_matakuliah')
                <div class="pesan-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="grup-input">
                <label>Jumlah Bobot Baru (SKS)</label>
                <input type="number" name="sks" value="{{ old('sks', $matakuliah->sks) }}">
                @error('sks')
                <div class="pesan-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="tombol-update">Perbarui Data</button>
        </form>
    </div>

</body>

</html>