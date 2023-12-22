<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use App\Models\Divisi;
use App\Models\Pengurus;
use App\Models\TransaksiPenilaian;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Laporan Pengurus';
        $pengurus = Pengurus::all()->where('Status',2);

        return view('laporans.index', compact('title'), ['penguruses' => $pengurus]);
    }

    public function indexOrg()
    {
        $title = 'Laporan Organisasi';
        $organisasi = Organisasi::all()->where('status',1);

        return view('laporans.indexOrg', compact('title'), ['organisasis' => $organisasi]);
    }

    public function indexDiv()
    {
        $title = 'Laporan Divisi';
        $divisi = Divisi::all()->where('status',1);

        return view('laporans.indexDiv', compact('title'), ['divisis' => $divisi]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    public function detail($Nim)
    {
        $title = "Detail Laporan Mahasiswa";
        $penguruses = TransaksiPenilaian::where('pengurus_id', $Nim)->get();

        $jumlahData = count($penguruses);
        $totalIntegritas = 0;
        $totalHandal = 0;
        $totalTangguh = 0;
        $totalKolaborasi = 0;
        $totalInovasi = 0;

        foreach ($penguruses as $nilai) {
            $totalIntegritas += $nilai->integritas;
            $totalHandal += $nilai->handal;
            $totalTangguh += $nilai->tangguh;
            $totalKolaborasi += $nilai->kolaborasi;
            $totalInovasi += $nilai->inovasi;
        }

        foreach($penguruses as $p){
            $nama = $p->pengurus->Nama;
        }

        $rataRata = [
            'Nim' => $Nim,
            'Nama' => ($jumlahData > 0) ? $nama : '',
            'integritas' => ($jumlahData > 0) ? $totalIntegritas / $jumlahData : 0,
            'handal' => ($jumlahData > 0) ? $totalHandal / $jumlahData : 0,
            'tangguh' => ($jumlahData > 0) ? $totalTangguh / $jumlahData : 0,
            'kolaborasi' => ($jumlahData > 0) ? $totalKolaborasi / $jumlahData : 0,
            'inovasi' => ($jumlahData > 0) ? $totalInovasi / $jumlahData : 0,
        ];

        return view('laporans.detail', compact('title', 'penguruses', 'rataRata'));
    }



    public function detailOrg($id)
    {
        $title = "Detail Laporan Organisasi";
        
        $penguruses = TransaksiPenilaian::join('penguruses', 'transaksi_penilaians.pengurus_id', '=', 'penguruses.Nim')
        ->join('organisasis', 'penguruses.organisasi_id', '=', 'organisasis.id')
        ->select('transaksi_penilaians.*', 'organisasis.nama_organisasi')
        ->where('penguruses.organisasi_id', $id) // Menggunakan ID organisasi yang diberikan
        ->get();

        $jumlahData = count($penguruses);
        $totalIntegritas = 0;
        $totalHandal = 0;
        $totalTangguh = 0;
        $totalKolaborasi = 0;
        $totalInovasi = 0;
        $Nama = "";

        foreach($penguruses as $organisasi){
            $nama = $organisasi->nama_organisasi;
        }

        foreach ($penguruses as $nilai) {
            $totalIntegritas += $nilai->integritas;
            $totalHandal += $nilai->handal;
            $totalTangguh += $nilai->tangguh;
            $totalKolaborasi += $nilai->kolaborasi;
            $totalInovasi += $nilai->inovasi;
        }

        $rataRata = [
            'Nama' => ($jumlahData > 0) ? $nama : $Nama,
            'integritas' => ($jumlahData > 0) ? $totalIntegritas / $jumlahData : 0,
            'handal' => ($jumlahData > 0) ? $totalHandal / $jumlahData : 0,
            'tangguh' => ($jumlahData > 0) ? $totalTangguh / $jumlahData : 0,
            'kolaborasi' => ($jumlahData > 0) ? $totalKolaborasi / $jumlahData : 0,
            'inovasi' => ($jumlahData > 0) ? $totalInovasi / $jumlahData : 0,
        ];

        return view('laporans.detailOrg', compact('title', 'rataRata','penguruses'));
    }

    public function detailDiv($id)
    {
        $title = "Detail Laporan Divisi";
        
        $penguruses = TransaksiPenilaian::join('penguruses', 'transaksi_penilaians.pengurus_id', '=', 'penguruses.Nim')
        ->join('divisis', 'penguruses.divisi_id', '=', 'divisis.id')
        ->select('transaksi_penilaians.*', 'divisis.nama_divisi')
        ->where('penguruses.divisi_id', $id) // Menggunakan ID organisasi yang diberikan
        ->get();

        $jumlahData = count($penguruses);
        $totalIntegritas = 0;
        $totalHandal = 0;
        $totalTangguh = 0;
        $totalKolaborasi = 0;
        $totalInovasi = 0;
        $Nama = "";

        foreach($penguruses as $divisi){
            $nama = $divisi->nama_divisi;
        }

        foreach ($penguruses as $nilai) {
            $totalIntegritas += $nilai->integritas;
            $totalHandal += $nilai->handal;
            $totalTangguh += $nilai->tangguh;
            $totalKolaborasi += $nilai->kolaborasi;
            $totalInovasi += $nilai->inovasi;
        }

        $rataRata = [
            'Nama' => ($jumlahData > 0) ? $nama : $Nama,
            'integritas' => ($jumlahData > 0) ? $totalIntegritas / $jumlahData : 0,
            'handal' => ($jumlahData > 0) ? $totalHandal / $jumlahData : 0,
            'tangguh' => ($jumlahData > 0) ? $totalTangguh / $jumlahData : 0,
            'kolaborasi' => ($jumlahData > 0) ? $totalKolaborasi / $jumlahData : 0,
            'inovasi' => ($jumlahData > 0) ? $totalInovasi / $jumlahData : 0,
        ];

        return view('laporans.detailDiv', compact('title', 'rataRata','penguruses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
