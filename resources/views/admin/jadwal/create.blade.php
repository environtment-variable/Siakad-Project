<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal Baru</title>
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

        .pesan-error {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .tombol-simpan {
            background: #16a34a;
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
        <h2>Form Tambah Jadwal Kuliah</h2>

        <form action="{{ route('admin.jadwal.store') }}" method="POST">
            @csrf

            <div class="grup-input">
                <label>Mata Kuliah</label>
                <select name="kode_matakuliah">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliahs as $mk)
                    <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                        [{{ $mk->kode_matakuliah }}] {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                    </option>
                    @endforeach
                </select>
                @error('kode_matakuliah') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Dosen Pengajar</label>
                <select name="nidn">
                    <option value="">-- Pilih Dosen Pengajar --</option>
                    @foreach($dosens as $ds)
                    <option value="{{ $ds->nidn }}" {{ old('nidn') == $ds->nidn ? 'selected' : '' }}>
                        {{ $ds->nama }}
                    </option>
                    @endforeach
                </select>
                @error('nidn') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Hari</label>
                <select name="hari">
                    <option value="">-- Pilih Hari --</option>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $h)
                    <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                    @endforeach
                </select>
                @error('hari') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Waktu / Jam (Contoh: 08:00 - 10:30)</label>
                <input type="text" name="jam" value="{{ old('jam') }}" placeholder="Format bebas, misal: 08:00 - 10:30">
                @error('jam') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Ruangan</label>
                <input type="text" name="ruangan" value="{{ old('ruangan') }}" placeholder="Contoh: Lab-01 atau R.302">
                @error('ruangan') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <div class="grup-input">
                <label>Kelas</label>
                <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: A, B, atau C">
                @error('kelas') <div class="pesan-error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="tombol-simpan">Simpan Jadwal Kuliah</button>
        </form>
    </div>

</body>

</html>