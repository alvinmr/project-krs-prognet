<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MatakuliahResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matakuliah = Matakuliah::all();
        return view('pages.pegawai.matakuliah.index', compact('matakuliah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status_matakuliah = Matakuliah::getEnumKey('status_matakuliah');
        $dosen = Dosen::all();
        $program_studi = Prodi::all();
        return view('pages.pegawai.matakuliah.create', compact('status_matakuliah', 'dosen', 'program_studi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kodeMatkul = ['TA', 'TS', 'TE', 'TM', 'TI', 'TL', 'TN'];

        $request->validate([
            'nama_matakuliah' => 'required',
            'semester' => 'required',
            'jumlah_sks' => 'required',
            'status_matakuliah' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'dosen' => 'required|numeric',
            'program_studi' => 'required|numeric'
        ]);

        Matakuliah::create([
            'kode' => $kodeMatkul[$request->program_studi - 1] . str_pad(Matakuliah::where('prodi_id', $request->program_studi)->count() + 1, 3, '0', STR_PAD_LEFT),
            'nama_matakuliah' => $request->nama_matakuliah,
            'semester' => $request->semester,
            'jumlah_sks' => $request->jumlah_sks,
            'status_matakuliah' => $request->status_matakuliah,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'dosen_id' => $request->dosen,
            'prodi_id' => $request->program_studi,
        ]);

        return redirect()->route('pegawai.matakuliah.index')->with('success', 'Data berhasil disimpan');
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
    public function edit(Matakuliah $matakuliah)
    {
        $status_matakuliah = Matakuliah::getEnumKey('status_matakuliah');
        $dosen = Dosen::all();
        $program_studi = Prodi::all();

        return view('pages.pegawai.matakuliah.edit', compact('status_matakuliah', 'dosen', 'program_studi', 'matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matakuliah $matakuliah)
    {
        $kodeMatkul = ['TA', 'TS', 'TE', 'TM', 'TI', 'TL', 'TN'];
        if ($request->program_studi != $matakuliah->prodi_id) {
            $matakuliah->kode = $kodeMatkul[$request->program_studi - 1] . str_pad(Matakuliah::where('prodi_id', $request->program_studi)->count() + 1, 3, '0', STR_PAD_LEFT);
            $matakuliah->save();
        }

        $matakuliah->update([
            'nama_matakuliah' => $request->nama_matakuliah,
            'semester' => $request->semester,
            'jumlah_sks' => $request->jumlah_sks,
            'status_matakuliah' => $request->status_matakuliah,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'dosen_id' => $request->dosen,
            'prodi_id' => $request->program_studi,
        ]);

        return redirect()->route('pegawai.matakuliah.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('pegawai.matakuliah.index')->with('success', 'Data berhasil dihapus');
    }
}