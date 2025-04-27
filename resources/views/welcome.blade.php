<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Absensi Pegawai Parmadenda</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <h2>Parmadenda</h2>
        <a href="{{ route('absen.create') }}">Tambah Absen</a>
        <a href="{{ route('absen.rekap') }}">Rekap Data</a>
    </div>

    <div class="content">
        <h1>Selamat Datang Pegawai Parmadenda!</h1>
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        <div class="buttons">
            <a href="{{ route('absen.create') }}" class="btn">Tambah Absen</a>
            <a href="{{ route('absen.rekap') }}" class="btn">Rekap Data</a>
        </div>
    </div>
</body>
</html>
