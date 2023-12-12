<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Http\Requests\JabatanStoreRequest;
use App\Http\Requests\JabatanUpdateRequest;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Session;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Menu Jabatan';
        $jabatan = Jabatan::all()->where('status','=','1');

        return view('jabatans.index', compact('title'), ['jabatans' => $jabatan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisi = Divisi::orderBy('nama_divisi', 'asc')->where('status', '=', '1')->get()->pluck('nama_divisi', 'id');
        $title = 'Tambah Jabatan';

        return view('jabatans.create', compact('title'),['divisis'=>$divisi]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JabatanStoreRequest $request)
    {
        $param = $request->validated();
        if ($jabatan = Jabatan::create($param)) {
            $jabatan->created_by = Session::get('logged_in')->id;
            $jabatan->modified_by = Session::get('logged_in')->id;
            $jabatan->save();
            return redirect(route('jabatans.index'))->with('success', 'Added!');
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
        //
        $divisi = Divisi::orderBy('nama_divisi', 'asc')->where('status', '=', '1')->get()->pluck('nama_divisi', 'id');
        $title = 'Edit Jabatan';
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatans.edit', compact('title'), ['jabatan' => $jabatan, 'divisis' => $divisi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JabatanUpdateRequest $request, $id)
    {
        //
        $jabatan = Jabatan::findOrFail($id);
        $params = $request->validated();

        if ($jabatan->update($params)) {
            $jabatan->modified_by = Session::get('logged_in')->id;
            $jabatan->save();

            return redirect(route('jabatans.index'))->with('success', 'Updated!');
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
        $jabatan = Jabatan::where('id', $id)->firstOrFail();

        if ($jabatan->update(['status' => 0])) {
            $jabatan->modified_by = Session::get('logged_in')->id;
            return redirect(route('jabatans.index'))->with('success', 'Deleted!');
        } else {
            return redirect(route('jabatans.index'))->with('error', 'Gagal Hapus Data!');
        }
    }
}
