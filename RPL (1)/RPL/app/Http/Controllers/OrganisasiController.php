<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrganisasiStoreRequest;
use App\Http\Requests\OrganisasiUpdateRequest;
use App\Models\Organisasi;
use Illuminate\Support\Facades\Session;

class OrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Menu Organisasi';
        $organisasi = Organisasi::all()->where('status','=','1');

        return view('organisasis.index', compact('title'), ['organisasis' => $organisasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Organisasi';

        return view('organisasis.create', compact('title'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganisasiStoreRequest $request)
    {

        $param = $request->validated();
        if ($organisasi = Organisasi::create($param)) {
            $organisasi->created_by = Session::get('logged_in')->id;
            $organisasi->modified_by = session::get('logged_in')->id;
            $organisasi->save();
            return redirect(route('organisasis.index'))->with('success', 'Added!');
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
        $title = 'Edit Organisasi';
        $organisasi = Organisasi::findOrFail($id);
        return view('organisasis.edit', compact('title'), ['organisasi' => $organisasi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganisasiUpdateRequest $request, $id)
    {
        //
        $organisasi = Organisasi::findOrFail($id);
        $params = $request->validated();

        if ($organisasi->update($params)) {
            $organisasi->modified_by = session::get('logged_in')->id;
            $organisasi->save();

            return redirect(route('organisasis.index'))->with('success', 'Updated!');
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
        $organisasi = Organisasi::where('id',$id)->firstOrFail();

        if($organisasi->update(['status' => 0])){
            $organisasi->modified_by = Session::get('logged_in')->id;
            return redirect(route('organisasis.index'))->with('success', 'Deleted!');
        } else {
            return redirect(route('organisasis.index'))->with('error', 'Gagal Hapus Data!');
        }
    }
}
