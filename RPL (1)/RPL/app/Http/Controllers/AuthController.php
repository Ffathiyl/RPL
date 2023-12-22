<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pengurus;
use App\Models\Organisasi;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Session::flash('username', $request->Username);

        $request->validate([
            'Username' => 'required',
            'Password' => 'required'
        ], [
            'Username.required' => 'Username wajib diisi.',
            'Password.required' => 'Password wajib diisi.'
        ]);

        $info = [
            'username' => $request->get('Username'),
            'password' => $request->get('Password'),
        ];

        // Check if the user is an admin
        $admin = Admin::where('username', $info['username'])->first();

        if ($admin) {
            if ($admin->Password == $info['password']) {
                // Autentikasi berhasil
                Auth::guard('admin')->login($admin);

                // Menyimpan informasi login
                $request->session()->put('logged_in', $admin);

                return redirect(route('Dashboard.dashboard'))->with('success', 'Login Berhasil!');
            } else {
                return redirect(route('logins.index'))->with('error', 'Password Salah!');
            }
        }

        // Check if the user is a pengurus
        $pengurus = Pengurus::where('nim', $info['username'])->first();

        if ($pengurus) {
            if ($pengurus->Password == $info['password']) {
                if ($pengurus->Status == 1) {
                    return redirect(route('auth.login_pengurus'))->with('error', 'Akun belum diaktifkan!');
                } else if ($pengurus->Status == 0) {
                    return redirect(route('auth.login_pengurus'))->with('error', 'Akun Tidak Aktif!');
                } else {
                    Auth::guard('pengurus')->login($pengurus);
                    $request->session()->put('logged_in', $pengurus);
                    return redirect(route('Dashboard.dashboard_pengurus'))->with('success', 'Berhasil Login!');
                }
            } else {
                return redirect(route('auth.login_pengurus'))->with('error', 'Password Salah!');
            }
        } else {
            return redirect(route('auth.login_pengurus'))->with('error', 'Username atau Password Salah!');
        }

        // Autentikasi gagal
        return redirect(route('logins.index'))->with('error', 'Username atau Password Salah!');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('logins.index'))->with('successLogout', 'Berhasil Logout');
    }

    public function logoutPengurus()
    {
        Auth::guard('pengurus')->logout();
        return redirect(route('logins.index'))->with('successLogout', 'Berhasil Logout');
    }

    public function LoginPengurus()
    {
        return view('auth.login');
    }

    public function Divisi($organisasi_id = null)
    {
        $organisasi = Divisi::with('organisasi')->whereHas('organisasi', function ($query) {
            // Filter organisasi dengan status 1
            $query->where('status', '=', 1);
        })->get();

        // Jika ada organisasi_id yang dikirim, ambil data berdasarkan organisasi_id
        if ($organisasi_id) {
            $divisis = Divisi::whereHas('organisasi', function ($query) use ($organisasi_id) {
                $query->where('id', $organisasi_id);
            })->get();
        } else {
            // Jika tidak ada organisasi_id yang dikirim, ambil semua data divisi dan organisasi
            $divisis = Divisi::with('organisasi')->whereHas('organisasi', function ($query) {
                // Filter organisasi dengan status 1
                $query->where('status', '=', 1);
            })->get();
        }

        // Mengambil data divisi dan organisasi untuk dropdown
        $divisiOrganisasi = $divisis->map(function ($divisi) {
            return [
                'organisasi_id' => $divisi->organisasi->id,
                'organisasi_nama' => $divisi->organisasi->nama_organisasi,
                'divisi_id' => $divisi->id,
                'divisi_nama' => $divisi->nama_divisi,
            ];
        });

        $Organisasi = $organisasi->unique('organisasi.id')->map(function ($divisi) {
            return [
                'organisasi_id' => $divisi->organisasi->id,
                'organisasi_nama' => $divisi->organisasi->nama_organisasi,
                'divisi_id' => $divisi->id,
                'divisi_nama' => $divisi->nama_divisi,
            ];
        });

        $title = 'Form Pengurus';
        $programStudi = ProgramStudi::orderBy('nama_program_studi', 'asc')->where('status', '=', '1')->get()->pluck('nama_program_studi', 'id');
        $jabatans = Jabatan::orderBy('nama_jabatan', 'asc')->where('status', '=', '1')->get()->pluck('nama_jabatan', 'id');

        return view('auth.create_pengurus', compact('divisiOrganisasi', 'divisis', 'jabatans', 'title', 'Organisasi', 'divisis', 'programStudi', 'organisasi_id'));

    }


    public function CreatePengurus(Request $request)
    {
        $request->validate([
            'Nim' => 'required|unique:penguruses,Nim',
            'Nama' => 'required',
            'organisasi_id' => 'required',
            'divisi_id' => 'required',
            'jabatan_id' => 'required',
            'prodi_id' => 'required',
            'Password' => 'required',
            'PasswordConfirmation' => 'required|same:Password'
        ], [
            'Nim.required' => 'Nim wajib diisi.',
            'Nim.unique' => 'Nim sudah digunakan.',
            'Nama.required' => 'Nama wajib diisi.',
            'organisasi_id.required' => 'Organisasi wajib diisi.',
            'divisi_id.required' => 'Divisi wajib diisi.',
            'jabatan_id.required' => 'Jabatan wajib diisi.',
            'prodi_id.required' => 'Prodi wajib diisi.',
            'Password.required' => 'Password wajib diisi.',
            'PasswordConfirmation.same' => 'Konfirmasi Password Tidak Sama',
        ]);

        $data = [
            'Nim' => $request->input('Nim'),
            'Nama' => $request->input('Nama'),
            'organisasi_id' => $request->input('organisasi_id'),
            'divisi_id' => $request->input('divisi_id'),
            'jabatan_id' => $request->input('jabatan_id'),
            'program_studi_id' => $request->input('prodi_id'),
            'Password' => $request->input('Password'),
            'Status' => '1',
        ];

        if (Pengurus::create($data)) {
            return redirect(route('auth.login_pengurus'))->with('success', 'Added!');
        } else {
            return redirect(route('auth.register'))->with('error', 'Error Register!');
        }
    }

    public function getDivisi(Request $request)
    {
        $organisasiId = $request->input('organisasi_id');
        $divisis = Divisi::where('organisasi_id', $organisasiId)->pluck('nama_divisi', 'id');
        return response()->json($divisis);
    }

    public function getJabatan(Request $request)
    {
        $divisiId = $request->input('divisi_id');
        $jabatans = Jabatan::whereHas('divisis', function ($query) use ($divisiId) {
            $query->where('divisi_id', $divisiId);
        })->pluck('nama_jabatan', 'id');
        return response()->json($jabatans);
    }
}

?>