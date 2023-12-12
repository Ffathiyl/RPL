<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\TransaksiPenilaian;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PengurusesController extends Controller
{

    public function index()
    {
        return view('Dashboard.dashboard_pengurus');
    }

    public function kuis($Nim)
    {

        $title = 'Isi Kuesioner';
        $pengurus = Pengurus::findOrFail($Nim);
        return view('penguruses.kuisioner', compact('title'), ['penguruses' => $pengurus]);
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'Integritas' => 'required|numeric|between:1,10',
            'Handal' => 'required|numeric|between:1,10',
            'Tangguh' => 'required|numeric|between:1,10',
            'Kolaborasi' => 'required|numeric|between:1,10',
            'Inovasi' => 'required|numeric|between:1,10',
            'pengurus_id' => 'required',
            'kritikSaran' => 'required|string',
        ]);

        $data = [
            'integritas' => $request->input('Integritas'),
            'handal' => $request->input('Handal'),
            'tangguh' => $request->input('Tangguh'),
            'kolaborasi' => $request->input('Kolaborasi'),
            'inovasi' => $request->input('Inovasi'),
            'kritik_saran' => $request->input('kritikSaran'),
            'penilai_id' => Session::get('logged_in')->Nim,
            'pengurus_id' => $request->input('pengurus_id'),
            'Status' => '1',
        ];

        if (TransaksiPenilaian::create($data)) {
            $title = 'Menu Penilaian';
            $nim = Session::get('logged_in')->Nim;
            $organisasiId = Session::get('logged_in')->organisasi_id;
            $divisiId = Session::get('logged_in')->divisi_id;

            if ($organisasiId == 1) {
                $pengurus = Pengurus::where('Status', '=', '1')
                    ->where('organisasi_id', '=', '1')
                    ->where('divisi_id', '=', $divisiId)
                    ->where('Nim', '!=', $nim)
                    ->get();
            } else {
                $pengurus = Pengurus::where('Status', '=', '1')
                    ->where('organisasi_id', '=', '2')
                    ->where('divisi_id', '=', $divisiId)
                    ->where('Nim', '!=', $nim)
                    ->get();
            }

            return redirect()->route('penguruses.index')->with('success', 'Penilaian berhasil disimpan.');

        } else {
            $title = 'Isi Kuesioner';
            return redirect(route('penguruses.kuisioner'))->with('error', 'Error saving evaluation. Please try again.')->withInput();
        }
    }

    public function penilaian()
    {
        $title = 'Menu Penilaian';
        $nim = Session::get('logged_in')->Nim;
        $organisasiId = Session::get('logged_in')->organisasi_id;
        $divisiId = Session::get('logged_in')->divisi_id;

        if ($organisasiId == 1) {
            $pengurus = Pengurus::where('Status', '=', '1')
                ->where('organisasi_id', '=', '1')
                ->where('divisi_id', '=', $divisiId)
                ->where('Nim', '!=', $nim)
                ->get();
        } else {
            $pengurus = Pengurus::where('Status', '=', '1')
                ->where('organisasi_id', '=', '2')
                ->where('divisi_id', '=', $divisiId)
                ->where('Nim', '!=', $nim)
                ->get();
        }

        return view('penguruses.index', compact('title'), ['penguruses' => $pengurus]);
    }


}

?>