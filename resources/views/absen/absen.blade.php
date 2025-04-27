@extends('layout')

@section('content')
    <h1>Form Absensi</h1>
    <form action="{{ route('absen.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama:</label>
            <select name="nama" required>
                <option value="">-- Pilih Nama --</option>
                <option value="Undang">Undang</option>
                <option value="Alex">Alex</option>
                <option value="Maya">Maya</option>
            </select>
        </div>
        <div class="form-group">
            <label>Jam Masuk:</label>
            <input type="text" name="jam_masuk" value="{{ now()->format('H:i') }}" readonly>
        </div>
        <button type="submit" class="btn">Simpan Absen</button>
    </form>
@endsection
