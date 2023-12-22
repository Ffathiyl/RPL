<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use App\Models\Pengurus;
use Illuminate\Http\Request;
use App\Http\Requests\DivisiStoreRequest;
use App\Http\Requests\DivisiUpdateRequest;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dashboard';

        // Menghitung jumlah total organisasi
        $totalOrganisasi = Organisasi::where('status', 1)->count();

        $totalAnggotaBem = Pengurus::where('organisasi_id', 1)->where('status', 1)->count();

        $totalAnggotaMpm = Pengurus::where('organisasi_id', 2)->where('status', 1)->count();

        $totalPengurus = Pengurus::where('status', 1)->count();

        return view('Dashboard.dashboard', compact('title', 'totalOrganisasi', 'totalAnggotaBem', 'totalAnggotaMpm','totalPengurus'));
    }
    public function indexp()
    {
        $title = 'Dashboard';

        // Menghitung jumlah total organisasi
        $totalOrganisasi = Organisasi::where('status', 1)->count();

        $totalAnggotaBem = Pengurus::where('organisasi_id', 1)->where('status', 1)->count();

        $totalAnggotaMpm = Pengurus::where('organisasi_id', 2)->where('status', 1)->count();

        $totalPengurus = Pengurus::where('status', 1)->count();

        return view('Dashboard.dashboard_pengurus', compact('title', 'totalOrganisasi', 'totalAnggotaBem', 'totalAnggotaMpm','totalPengurus'));
    }
}