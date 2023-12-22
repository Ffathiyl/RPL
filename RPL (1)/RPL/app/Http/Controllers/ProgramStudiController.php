<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProgramStudiStoreRequest;
use App\Http\Requests\ProgramStudiUpdateRequest;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Session;

class ProgramStudiController extends Controller
{
    //
               /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title='Menu Program Studi';
        $programStudi = ProgramStudi::all()->where('status','=','1');

        return view('programStudis.index', compact('title'),['programStudis' => $programStudi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='Tambah Program Studi';
        
        return view('programStudis.create',compact('title'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramStudiStoreRequest $request)
    {
        $param = $request->validated();
        if ($programStudi = ProgramStudi::create($param)) {
            $programStudi->created_by = Session::get('logged_in')->id;
            $programStudi->modified_by = Session::get('logged_in')->id;
            $programStudi->save();
            return redirect(route('programStudis.index'))->with('success', 'Added!');
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
        $title='Edit Program Studi';
        $programStudi = ProgramStudi::findOrFail($id);
        return view('programStudis.edit', compact('title'),['programStudi' => $programStudi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramStudiUpdateRequest $request, $id)
    {
        //
        $programStudi = ProgramStudi::findOrFail($id);
        $params = $request->validated();

        if ($programStudi->update($params)) {
            $programStudi->modified_by = Session::get('logged_in')->id;
            $programStudi->save();

            return redirect(route('programStudis.index'))->with('success', 'Updated!');
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
        $prodi = ProgramStudi::where('id',$id)->firstOrFail();

        if($prodi->update(['Status' => 0])){
            return redirect(route('programStudis.index'))->with('success', 'Data Berhasil Dihapus!');
        } else {
            return redirect(route('programStudis.index'))->with('error', 'Gagal Hapus Data!');
        }
    }
}
