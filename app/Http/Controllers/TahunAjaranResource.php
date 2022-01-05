<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunajaran = TahunAjaran::all();
        return view('pages.pegawai.tahunajaran.index', compact('tahunajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahunajaran = TahunAjaran::all();
        return view('pages.pegawai.tahunajaran.create', compact('tahunajaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTahunAjaran(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        TahunAjaran::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('pegawai.tahunajaran-index')->with('success', 'Data berhasil disimpan');
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
        $tahunajaran = TahunAjaran::find($id);
        return view('pages.pegawai.tahunajaran.edit', compact('tahunajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TahunAjaran $tahunajaran)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $tahunajaran->update([
            'nama' => $request->nama
        ]);
        return redirect()->route('pegawai.tahunajaran-index')->with('success', 'Data berhasil diupdate');
    }

    public function publish(Request $request, TahunAjaran $tahunajaran)
    {
        DB::table('mahasiswa')->update(['semester' => DB::raw('semester+1')]);
        return redirect()->route('pegawai.tahunajaran-index')->with('success', 'Data berhasil dipublish');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tahunajaran = TahunAjaran::find($id);
            $tahunajaran->delete();
        } catch (\Throwable $th) {
            return redirect()->route('pegawai.tahunajaran-index')->with('failed', 'Data gagal dihapus, kemungkinan karna data ini sudah berelasi dengan data lain');;
        }
        return redirect()->route('pegawai.tahunajaran-index')->with('success', 'Data berhasil dihapus');
    }
}
