<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        $data = Session::get('absen_data', []);
    
        $jamMasuk = $request->jam_masuk;
        $tanggal = date('d'); // Ambil tanggal hari ini
        $bulan = date('F');   // Ambil nama bulan, misal: April
    
        $telat = strtotime($jamMasuk) > strtotime('08:00') ? true : false;
    
        $data[] = [
            'nama' => $request->nama,
            'jam_masuk' => $jamMasuk,
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'telat' => $telat,
        ];
    
        Session::put('absen_data', $data);
    
        return redirect()->route('home');
    }
    

    public function rekap(Request $request)
    {
        $data = Session::get('absen_data', []);
    
        $selectedMonth = $request->input('bulan', date('F')); // default bulan sekarang
    
        $filtered = array_filter($data, function ($absen) use ($selectedMonth) {
            return isset($absen['bulan']) && $absen['bulan'] === $selectedMonth;
        });
        
    
        $rekap = [];
    
        foreach ($filtered as $absen) {
            $nama = $absen['nama'];
    
            if (!isset($rekap[$nama])) {
                $rekap[$nama] = ['tepat' => 0, 'telat' => 0];
            }
    
            if ($absen['telat']) {
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
