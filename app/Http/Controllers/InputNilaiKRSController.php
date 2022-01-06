<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\TahunAjaran;
use App\Models\TransaksiKrs;
use Illuminate\Http\Request;

class InputNilaiKRSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->tahun_ajaran_id) {
            $matakuliah = Matakuliah::whereTahunAjaranId(TahunAjaran::orderBy('id', 'desc')->first()->id)->get();
        } else {
            $matakuliah = Matakuliah::whereTahunAjaranId($request->tahun_ajaran_id)->get();
        }
        $tahun_ajaran = TahunAjaran::all();
        return view('pages.pegawai.input-nilai.index', compact('matakuliah', 'tahun_ajaran'));
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
    public function show(Request $request, $id)
    {
        $matakuliah = Matakuliah::find($id);
        if (!$request) {
            $mahasiswaInMatakuliah = TransaksiKrs::whereMatakuliahId($id)->whereStatus('disetujui')->get();
        } else {
            $mahasiswaInMatakuliah = TransaksiKrs::whereMatakuliahId($id)->whereStatus('disetujui')->get();
        }
        return view('pages.pegawai.input-nilai.show', compact('matakuliah', 'mahasiswaInMatakuliah'));
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