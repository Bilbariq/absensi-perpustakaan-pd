<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $telat = strtotime($jamMasuk) > strtotime('08:00') ? true : false;

        $data[] = [
            'nama' => $request->nama,
            'jam_masuk' => $jamMasuk,
            'telat' => $telat,
        ];

        Session::put('absen_data', $data);

        return redirect()->route('home');
    }

    public function rekap()
    {
        $data = Session::get('absen_data', []);

        $rekap = [];

        foreach ($data as $absen) {
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

        return view('absen.rekap', compact('rekap'));
    }
}
