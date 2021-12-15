<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiKrs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use DB;

class KRSController extends Controller
{
    public function showTableKRS()
    {
        $mahasiswas = auth('mahasiswa')->user()->id;
        $listKRS = TransaksiKrs::where('mahasiswa_id', '=', $mahasiswas)->get();
        /* $listKRSs = TransaksiKrs::all(); */
        return view('pages.mahasiswa.krs.index', compact('listKRS'));
        /* return view('pages.mahasiswa.krs.index', compact('listKRSs')); */
    }

    public function showDetailMatakuliah($id)
    {
        $listMataKuliahs = Matakuliah::find($id);
        return view('pages.mahasiswa.krs.detail', compact('listMataKuliahs'));
    }

    public function showCreateTableKRS()
    {
        $listMataKuliahs = Matakuliah::all();
        return view("pages.mahasiswa.krs.create", compact('listMataKuliahs'));
    }

    public function storeKRS($id)
    {
        $matakuliah = Matakuliah::find($id);
        $krs = new TransaksiKrs;

        if (!auth('mahasiswa')->user()->transaksi_krs->contains('matakuliah_id', $matakuliah->id)) {
            $krs->matakuliah_id = $matakuliah->id;
            $krs->tahun_ajaran = '2021';
            $krs->semester = $matakuliah->semester;
            $krs->nilai = 'Tunda';
            $krs->status = 'pending';
            $krs->mahasiswa_id = auth('mahasiswa')->user()->id;

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
}