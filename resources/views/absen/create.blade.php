<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Absen</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <h2>Parmadenda</h2>
        <a href="/">Home</a>
        <a href="{{ route('absen.rekap') }}">Rekap Data</a>
    </div>

    <div class="content">
        <h1>Form Absen</h1>
        <form action="{{ route('absen.store') }}" method="POST">
            @csrf
            <label for="nama">Nama:</label>
            <select name="nama" id="nama" required>
                <option value="">-- Pilih Nama --</option>
                @foreach ($namaPegawai as $nama)
                    <option value="{{ $nama }}">{{ $nama }}</option>
                @endforeach
            </select>

            <label for="jam_masuk">Jam Masuk (otomatis):</label>
            <input type="text" name="jam_masuk" id="jam_masuk" value="{{ \Carbon\Carbon::now()->format('H:i:s') }}" readonly>

            <button type="submit" class="btn">Simpan Absen</button>
        </form>
    </div>
</body>
</html>
