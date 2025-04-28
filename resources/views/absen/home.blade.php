@extends('absen.layout')

@section('content')
    <h1>Selamat Datang Pegawai Parmadenda!</h1>
    <div class="button-group">
        <a href="{{ route('absen.create') }}" class="btn">Tambah Absen</a>
        <a href="{{ route('absen.rekap') }}" class="btn">Rekap Data</a>
    </div>
@endsection
