<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Parmadenda</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Parmadenda">
            </div>
            <nav class="nav-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('absen.create') }}">Tambah Absen</a>
                <a href="{{ route('absen.rekap') }}">Rekap Data</a>
            </nav>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
