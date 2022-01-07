<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKrs;
use App\Models\Matakuliah;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class KRSController extends Controller
{
    public function showTableKRS(Request $request)
    {
        $mahasiswas = auth('mahasiswa')->user()->id;
        $tahun_ajaran = TahunAjaran::limit(auth('mahasiswa')->user()->semester)->get();
        if (!$request->tahun_ajaran_id) {
            $listKRS = TransaksiKrs::whereMahasiswaId($mahasiswas)->whereTahunAjaranId(TahunAjaran::orderBy('id', 'desc')->first()->id)->get();
        } else {
            $listKRS = TransaksiKrs::whereMahasiswaId($mahasiswas)->whereTahunAjaranId($request->tahun_ajaran_id)->get();
        }
        return view('pages.mahasiswa.krs.index', compact('listKRS', 'tahun_ajaran'));
    }

    public function showDetailMatakuliah($id)
    {
        $listMataKuliahs = Matakuliah::find($id);
        return view('pages.mahasiswa.krs.detail', compact('listMataKuliahs'));
    }

    public function showCreateTableKRS()
    {
        $listMataKuliahs = Matakuliah::whereTahunAjaranId(TahunAjaran::orderBy('id', 'desc')->first()->id)->whereDoesntHave('transaksi_krs', function ($query) {
            $query->whereMahasiswaId(auth('mahasiswa')->user()->id);
        })->get();
        return view("pages.mahasiswa.krs.create", compact('listMataKuliahs'));
    }

    public function storeKRS($id)
    {
        $matakuliah = Matakuliah::find($id);
        $krs = new TransaksiKrs;

        if (!auth('mahasiswa')->user()->transaksi_krs->contains('matakuliah_id', $matakuliah->id)) {
            $krs->matakuliah_id = $matakuliah->id;
            $krs->semester = $matakuliah->semester;
            $krs->nilai = 'Tunda';
            $krs->status = 'pending';
            $krs->mahasiswa_id = auth('mahasiswa')->user()->id;
            $krs->tahun_ajaran_id = TahunAjaran::orderBy('id', 'desc')->first()->id;

            $krs->save();
            return redirect()->route('mahasiswa.krs-create')->with('success', 'KRS Telah Ditambahkan');
        }
        return redirect()->route('mahasiswa.krs-create')->with('failed', 'Matakuliah sudah pernah ditambahkan');
    }

    public function storeDeleteTableKRS($id)
    {
        $krs = TransaksiKrs::where('id', $id)->delete();
        return redirect()->route('mahasiswa.krs-index')->with('success', 'KRS Berhasil Dihapus');
    }

    public function listMahasiswa($id)
    {
        $list_mahasiswa = TransaksiKrs::whereMatakuliahId($id)->whereStatus('disetujui')->get();
        $matakuliah = Matakuliah::find($id);
        return view('pages.mahasiswa.krs.list-mahasiswa', compact('list_mahasiswa', 'matakuliah'));
    }
}