<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MahasiswaResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('pages.pegawai.mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $angkatans = Mahasiswa::getEnumKey('angkatan');
        $prodis = Prodi::all();
        return view('pages.pegawai.mahasiswa.create', compact('angkatans', 'prodis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Kode prodi, array key nya sesuai sama id di tabel prodi
        $kodeProdi = ['5521', '5511', '5541', '5531', '5551', '5561', '5571'];

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required|numeric',
            'angkatan' => 'required',
            'prodi' => 'required',
            'foto_mahasiswa' => 'required|max:2048'
        ]);
        $nim = substr($request->angkatan, 2) . '0' . $kodeProdi[$request->prodi - 1] . str_pad(Mahasiswa::where('prodi_id', $request->prodi)->count() + 1, 2, '0', STR_PAD_LEFT);
        $foto = $request->file('foto_mahasiswa');
        $nameFile = date('ymdhis') . '_' . $request->nama . '.' . $foto->getClientOriginalExtension();
        $foto->storeAs('foto_mahasiswa', $nameFile);
        Mahasiswa::create([
            'nim' => $nim,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'angkatan' => $request->angkatan,
            'prodi_id' => $request->prodi,
            'foto_mahasiswa' => $nameFile,
            'password' => Hash::make($nim)
        ]);

        return redirect()->route('pegawai.mahasiswa.index');
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
    public function edit(Mahasiswa $mahasiswa)
    {
        $angkatans = Mahasiswa::getEnumKey('angkatan');
        $prodis = Prodi::all();
        return view('pages.pegawai.mahasiswa.edit', compact('mahasiswa', 'angkatans', 'prodis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // Kode prodi, array key nya sesuai sama id di tabel prodi
        $kodeProdi = ['5521', '5511', '5541', '5531', '5551', '5561', '5571'];

        if ($request->file('foto_mahasiswa')) {
            Storage::delete('foto_mahasiswa/' . $mahasiswa->foto_mahasiswa);
            $foto = $request->file('foto_mahasiswa');
            $nameFile = date('ymdhis') . '_' . $request->nama . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('foto_mahasiswa', $nameFile);
        }
        if ($request->prodi != $mahasiswa->prodi_id || $request->angkatan != $mahasiswa->angkatan) {
            $nim = substr($request->angkatan, 2) . '0' . $kodeProdi[$request->prodi - 1] . str_pad(Mahasiswa::where('prodi_id', $request->prodi)->count() + 1, 2, '0', STR_PAD_LEFT);
            $mahasiswa->nim = $nim;
            $mahasiswa->save();
        }
        $mahasiswa->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'angkatan' => $request->angkatan,
            'prodi_id' => $request->prodi,
            'foto_mahasiswa' => $nameFile
        ]);
        return redirect()->route('pegawai.mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        Storage::delete('foto_mahasiswa/' . $mahasiswa->foto_mahasiswa);
        $mahasiswa->delete();
        return redirect()->route('pegawai.mahasiswa.index');
    }
}