<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Organisasi;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Menu Pengurus';
        $pengurus = Pengurus::where('Status','!=','0')->get();
        return view('pengurus.index',compact('title'),['penguruses'=>$pengurus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengurus.create');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        $title = 'Edit Pengurus';
        $organisasi = Organisasi::orderBy('nama_organisasi','asc')->where('status','!=','0')->get()->pluck('nama_organisasi','id');
        $divisi = Divisi::orderBy('nama_divisi', 'asc')->where('status', '=', '1')->get()->pluck('nama_divisi', 'id');
        $jabatan = Jabatan::orderBy('nama_jabatan', 'asc')->where('status', '=', '1')->get()->pluck('nama_jabatan', 'id');
        $programStudi = ProgramStudi::orderBy('nama_program_studi', 'asc')->where('status', '=', '1')->get()->pluck('nama_program_studi', 'id');

        $pengurus = Pengurus::where('Nim',$nim)->firstOrFail();
        return view('pengurus.edit', compact('title'),['penguruses' => $pengurus,
            'organisasis' => $organisasi,
            'divisis' => $divisi,
            'jabatans' => $jabatan,
            'programStudis' => $programStudi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        $modifiedBy = Session::get('logged_in')->Nama;
        $pengurus = Pengurus::where('Nim', $nim)->firstOrFail();
    
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'organisasi_id' => 'required',
            'divisi_id' => 'required',
            'jabatan_id' => 'required',
            'prodi_id' => 'required',
            'Password' => 'nullable|min:6',
            'PasswordConfirmation' => 'nullable|min:6|same:Password',
        ], [
            'Nim.required' => 'Nim wajib diisi.',
            'Nama.required' => 'Nama wajib diisi.',
            'organisasi_id.required' => 'Organisasi wajib diisi.',
            'divisi_id.required' => 'Divisi wajib diisi.',
            'jabatan_id.required' => 'Jabatan wajib diisi.',
            'prodi_id.required' => 'Prodi wajib diisi.',
            'Password.min' => 'Password minimal 6 karakter.',
            'PasswordConfirmation.same' => 'Konfirmasi Password Tidak Sama.',
        ]);
    
        $data = [
            'Nim' => $request->Nim,
            'Nama' => $request->Nama,
            'Id_Organisasi' => $request->organisasi_id,
            'Id_Divisi' => $request->divisi_id,
            'Id_Jabatan' => $request->jabatan_id,
            'Id_Prodi' => $request->prodi_id,
            'modified_by' => $modifiedBy,
        ];
    
        // Update the password only if it's not null
        if ($request->filled('Password')) {
            $data['Password'] = $request->Password;
        }
    
        $pengurus->update($data);
    
        return redirect(route('pengurus.index'))->with('success', 'Updated!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        
        $pengurus = Pengurus::where('Nim',$nim)->firstOrFail();

        if($pengurus->update(['Status' => 0])){
            return redirect(route('pengurus.index'))->with('success', 'Deleted!');
        } else {
            return redirect(route('pengurus.index'))->with('error', 'Gagal Hapus Data!');
        }

    }

    public function indexAcc(){
        $title = "Pengajuan Akun";
        $pengurus = Pengurus::all()->where('Status','1');
        return view('pengurus.pengajuan',['penguruses'=>$pengurus],compact('title'));
    }

    public function AccAkun($nim){
        $pengurus = Pengurus::where('Nim',$nim)->firstOrFail();

        if($pengurus->update(['Status' => 2])){
            return redirect(route('pengurus.indexAcc'))->with('success', 'Akun telah dibuat!');
        } else {
            return redirect(route('pengurus.indexAcc'))->with('error', 'Gagal terima akun!');
        }
    }

    public function pdf(){
        return view('pdf');
    }
}
