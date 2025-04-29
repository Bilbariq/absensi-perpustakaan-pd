<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Pagination\LengthAwarePaginator;

class AbsenController extends Controller
{
    public function home()
    {
        return view('absen.home');
    }

    public function create()
    {
        return view('absen.absen');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jam_masuk' => 'required',
        ]);

        $jamMasuk = $request->jam_masuk;
        $tanggal = date('Y-m-d'); // format tanggal database
        $bulan = date('F');        // nama bulan (April, Mei, dst)

        $status = strtotime($jamMasuk) > strtotime('08:00') ? 'telat' : 'tepat';

        // Simpan ke database
        Absensi::create([
            'nama' => $request->nama,
            'jam_masuk' => $jamMasuk,
            'status' => $status,
            'tanggal' => $tanggal,
            'bulan' => $bulan,
        ]);

        return redirect()->route('home');
    }

    public function rekap(Request $request)
    {
        $selectedMonth = $request->input('bulan', date('F'));

        // Ambil data dari database
        $data = Absensi::where('bulan', $selectedMonth)->get();

        $rekap = [];

        foreach ($data as $absen) {
            $nama = $absen->nama;

            if (!isset($rekap[$nama])) {
                $rekap[$nama] = ['tepat' => 0, 'telat' => 0];
            }

            if ($absen->status == 'telat') {
                $rekap[$nama]['telat']++;
            } else {
                $rekap[$nama]['tepat']++;
            }
        }

        // Bikin pagination manual
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $rekapPaginated = new LengthAwarePaginator(
            array_slice($rekap, ($page - 1) * $perPage, $perPage),
            count($rekap),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('absen.rekap', compact('rekapPaginated', 'selectedMonth'));
    }
}
