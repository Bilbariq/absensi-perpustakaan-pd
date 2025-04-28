@extends('absen.layout')
@section('content')
<div class="rekap-container">
    <h2>Rekap Bulan {{ $selectedMonth }}</h2>

    <form method="GET" action="{{ route('absen.rekap') }}">
        <select name="bulan" onchange="this.form.submit()">
            @foreach(['January', 'February', 'March', 'April', 'May', 'June',
                      'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>{{ $month }}</option>
            @endforeach
        </select>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tepat Waktu</th>
                <th>Telat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekapPaginated as $nama => $rekap)
            <tr>
                <td>{{ $nama }}</td>
                <td>{{ $rekap['tepat'] }}</td>
                <td>{{ $rekap['telat'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $rekapPaginated->links() }}
    </div>
</div>
@endsection
