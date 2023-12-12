<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;
use App\Http\Requests\DivisiStoreRequest;
use App\Http\Requests\DivisiUpdateRequest;
use App\Models\Divisi;
use Illuminate\Support\Facades\Session;

class DivisiController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title='Menu Divisi';
        $divisi = Divisi::all()->where('status','=','1');

        return view('divisis.index', compact('title'),['divisis' => $divisi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organisasi = Organisasi::orderBy('nama_organisasi','asc')->where('status','!=','0')->get()->pluck('nama_organisasi','id');
        $title='Tambah Divisi';
        
        return view('divisis.create',compact('title'),['organisasis'=>$organisasi]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DivisiStoreRequest $request)
    {
        $param = $request->validated();
        if ($divisi = Divisi::create($param)) {
            $divisi->created_by = Session::get('logged_in')->id;
            $divisi->modified_by = Session::get('logged_in')->id;
            $divisi->save();
            return redirect(route('divisis.index'))->with('success', 'Added!');
        }
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
    public function edit($id)
    {
        $organisasi = Organisasi::orderBy('nama_organisasi','asc')->where('status','!=','0')->get()->pluck('nama_organisasi','id');
        $title='Edit Divisi';
        $divisi = Divisi::findOrFail($id);
        return view('divisis.edit', compact('title'),['divisi' => $divisi, 'organisasis'=>$organisasi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DivisiUpdateRequest $request, $id)
    {
        //
        $divisi = Divisi::findOrFail($id);
        $params = $request->validated();

        if ($divisi->update($params)) {
            $divisi->modified_by = Session::get('logged_in')->id;
            $divisi->save();

            return redirect(route('divisis.index'))->with('success', 'Updated!');
        }
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
        $divisi = Divisi::where('id',$id)->firstOrFail();

        if($divisi->update(['status' => 0])){
            $divisi->modified_by = Session::get('logged_in')->id;
            return redirect(route('divisis.index'))->with('success', 'Deleted!');
        } else {
            return redirect(route('divisis.index'))->with('error', 'Gagal Hapus Data!');
        }
    }
}
