<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
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
            max-width: 500px;
            margin: auto;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .btn-submit {
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

    <div class="container">
        <a href="{{ route('admin.mahasiswa.index') }}" style="text-decoration: none;">⬅ Kembali</a>
        <h2>Tambah Data Mahasiswa</h2>

        <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="npm">NPM (10 Karakter)</label>
                <input type="text" id="npm" name="npm" value="{{ old('npm') }}">
                @error('npm') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama Mahasiswa</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}">
                @error('nama') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="nidn">Dosen Wali</label>
                <select id="nidn" name="nidn">
                    <option value="">-- Pilih Dosen Wali --</option>
                    @foreach($dosens as $dosen)
                    <option value="{{ $dosen->nidn }}" {{ old('nidn') == $dosen->nidn ? 'selected' : '' }}>
                        {{ $dosen->nama }} ({{ $dosen->nidn }})
                    </option>
                    @endforeach
                </select>
                @error('nidn') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-submit">Simpan Data</button>
        </form>
    </div>

</body>

</html>