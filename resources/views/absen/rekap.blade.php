@extends('layout')

@section('content')
    <h1>Rekap Absensi</h1>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tepat Waktu</th>
                <th>Telat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $nama => $data)
                <tr>
                    <td>{{ $nama }}</td>
                    <td>{{ $data['tepat'] }}</td>
                    <td>{{ $data['telat'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
