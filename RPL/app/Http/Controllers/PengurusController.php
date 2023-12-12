<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
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
        $pengurus = Pengurus::where('Nim',$nim)->firstOrFail();
        return view('pengurus.edit', compact('title'),['penguruses'=>$pengurus]);
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
        $pengurus = Pengurus::where('Nim',$nim)->firstOrFail();
        
        $data=([
            'Nim'=>$request->Nim,
            'Nama'=>$request->Nama,
            'Id_Organisasi'=>$request->Id_Organisasi,
            'Id_Divisi'=>$request->Id_Divisi,
            'Id_Jabatan'=>$request->Id_Jabatan,
            'Id_Prodi'=>$request->Id_Prodi,
            'Password'=>$request->Password,
            'modified_by'=>$modifiedBy,
        ]);

        if ($pengurus->Update($data)) {
            $pengurus->save();

            return redirect(route('pengurus.index'))->with('success', 'Updated!');
        }
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
}
