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

    public function LoginAuth(Request $request)
    {
        Session::flash('username', $request->Username);

        $request->validate([
            'Username' => 'required',
            'Password' => 'required'
        ], [
            'Username.required' => 'Username wajib diisi.',
            'Password.required' => 'Password wajib diisi.'
        ]);

        // echo 'alert(' . $request->Username . ');';
        // echo 'alert(' . $request->Password . ');';
        // $admins = Admin::where('username', $request->Username)->where('password',$request->Password)->where('status', '1')->first();
        // echo $admins->Nama;
        $info = [
            'username' => $request->get('Username'),
            'password' => $request->get('Password'),
        ];

        $admin = Admin::where('username', $info['username'])->first();

        if ($admin) {
            if ($admin->Password == $info['password']) {
                // Autentikasi berhasil
                Auth::guard('admin')->login($admin);

                //Menyimpan informasi login
                $request->session()->put('logged_in', $admin);

                return redirect(route('Dashboard.dashboard'))->with('success', 'Login Berhasil!');
            } else {
                return redirect(route('logins.index'))->with('error', 'Password Salah!');
            }
        } else {
            // Autentikasi gagal
            return redirect(route('logins.index'))->with('error', 'Username atau Password Salah!');
        }
    }

    public function LoginPengurusAction(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Password' => 'required',
        ], [
            'Nim.required' => 'Nim Wajib Diisi.',
            'Password.required' => 'Password Wajib Diisi.',
        ]);

        $info = [
            'nim' => $request->Nim,
            'password' => $request->Password,
        ];

        $pengurus = Pengurus::where('nim', $info['nim'])->first();

        if ($pengurus) {
            if ($pengurus->Password == $info['password']) {
                Auth::guard('pengurus')->login($pengurus);
                $request->session()->put('logged_in', $pengurus);
                return redirect(route('Dashboard.dashboard_pengurus'))->with('success', 'Berhasil Login!');
            } else {
                return redirect(route('auth.login_pengurus'))->with('error', 'Password Salah!');
            }
        } else {
            return redirect(route('auth.login_pengurus'))->with('error', 'Username atau Password Salah!');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('logins.index'))->with('successLogout', 'Berhasil Logout');
    }

    public function logoutPengurus()
    {
        Auth::guard('pengurus')->logout();
        return redirect(route('auth.login_pengurus'))->with('successLogout', 'Berhasil Logout');
    }

    public function LoginPengurus()
    {
        return view('auth.login_pengurus');
    }



    public function Pengurus()
    {
        $organisasi = Organisasi::orderBy('nama_organisasi','asc')->where('status','!=','0')->get()->pluck('nama_organisasi','id');
        $divisi = Divisi::orderBy('nama_divisi', 'asc')->where('status', '=', '1')->get()->pluck('nama_divisi', 'id');
        $jabatan = Jabatan::orderBy('nama_jabatan', 'asc')->where('status', '=', '1')->get()->pluck('nama_jabatan', 'id');
        $programStudi = ProgramStudi::orderBy('nama_program_studi', 'asc')->where('status', '=', '1')->get()->pluck('nama_program_studi', 'id');

        return view('auth.create_pengurus', [
            'organisasis' => $organisasi,
            'divisis' => $divisi,
            'jabatans' => $jabatan,
            'programStudis' => $programStudi,
        ]);

    }

    public function CreatePengurus(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'organisasi_id' => 'required',
            'divisi_id' => 'required',
            'jabatan_id' => 'required',
            'prodi_id' => 'required',
            'Password' => 'required',
            'PasswordConfirmation' => 'required|same:Password'
        ], [
            'Nim.required' => 'Nim wajib diisi.',
            'Nama.required' => 'Nama wajib diisi.',
            'organisasi_id.required' => 'Organisasi wajib diisi.',
            'divisi_id.required' => 'Divisi wajib diisi.',
            'jabatan_id.required' => 'Jabatan wajib diisi.',
            'prodi_id.required' => 'Prodi wajib diisi.',
            'Password.required' => 'Password wajib diisi.',
            'PasswordConfirmation.same' => 'Konfimasi Password Tidak Sama',
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

        if(Pengurus::create($data)){
            return redirect(route('auth.login_pengurus'))->with('success', 'Added!');
        } else {
            return redirect(route('auth.register'))->with('error', 'Error Register!');
        }
    }

}

?>