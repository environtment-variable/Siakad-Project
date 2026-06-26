<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ubah Informasi Jadwal</title>
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
            max-width: 550px;
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

        .grup-input input,
        .grup-input select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .tombol-update {
            background: #ea580c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
        }
    </style>
</head>

<body>

    <div class="kotak">
        <a href="{{ route('admin.jadwal.index') }}" style="text-decoration: none;">⬅ Kembali</a>
        <h2>Form Ubah Jadwal Kuliah</h2>

        <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grup-input">
                <label>Mata Kuliah</label>
                <select name="kode_matakuliah">
                    @foreach($matakuliahs as $mk)
                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>
                        [{{ $mk->kode_matakuliah }}] {{ $mk->nama_matakuliah }}
                    </option>
                    @endforeach
                </select>
                @error('kode_matakuliah') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Dosen Pengajar</label>
                <select name="nidn">
                    @foreach($dosens as $ds)
                    <option value="{{ $ds->nidn }}" {{ old('nidn', $jadwal->nidn) == $ds->nidn ? 'selected' : '' }}>
                        {{ $ds->nama }}
                    </option>
                    @endforeach
                </select>
                @error('nidn') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Hari</label>
                <select name="hari">
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $h)
                    <option value="{{ $h }}" {{ old('hari', $jadwal->hari) == $h ? 'selected' : '' }}>{{ $h }}</option>
                    @endforeach
                </select>
                @error('hari') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Waktu / Jam</label>
                <input type="text" name="jam" value="{{ old('jam', $jadwal->jam) }}">
                @error('jam') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Ruangan</label>
                <input type="text" name="ruangan" value="{{ old('ruangan', $jadwal->ruangan) }}">
                @error('ruangan') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Kelas</label>
                <input type="text" name="kelas" value="{{ old('kelas', $jadwal->kelas) }}" placeholder="Contoh: A, B, atau C" required>
                @error('kelas') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="tombol-update">Perbarui Jadwal Kuliah</button>
        </form>
    </div>

</body>

</html>