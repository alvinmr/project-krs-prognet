<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKrs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Http\Request;

class KRSPegawaiController extends Controller
{
    public function approve($id)
    {
        $krs = TransaksiKrs::find($id);
        $krs->status = 'disetujui';
        $krs->update();
        return view('pages.pegawai.krs.index', compact($krs));
    }


    public function decline($id)
    {
        $krs = TransaksiKrs::find($id);
        $krs->status = 'ditolak';
        $krs->update();
        return view('pages.pegawai.krs.index', compact($krs));
    }

    public function showTableKRS()
    {
        $mahasiswa = Mahasiswa::whereHas('transaksi_krs')->get();
        return view('pages.pegawai.krs.index', compact('mahasiswa'));
    }

    public function showDetailMatakuliah($id)
    {
        $listMataKuliahs = Matakuliah::find($id);
        return view('pages.pegawai.krs.detail', compact('listMataKuliahs'));
    }

    public function showCreateTableKRS()
    {
        $listMataKuliahs = Matakuliah::all();
        return view("pages.pegawai.krs.create", compact('listMataKuliahs'));
    }


    /* Disini mau buat nanti klik si mahasiswanya terus nanti idnya masukin sini; */
    public function storeKRS(Request $id)
    {
        $matakuliah = Matakuliah::find($id);
        $krs = new TransaksiKrs;

        $krs->matakuliah_id = $matakuliah->id;
        $krs->tahun_ajaran = '2021';
        $krs->semester = $matakuliah->semester;
        $krs->nilai = 'A';
        $krs->status = 'pending';
        $krs->mahasiswa_id = $id;

        $krs->save();
        return redirect()->route('pegawai.krs-index')->with('status', 'KRS Telah Ditambahkan');
    }

    public function storeDeleteTableKRS($id)
    {
        $krs = TransaksiKrs::where('id', $id)->delete();
        return redirect()->route('pegawai.krs-index')->with('status', 'Data KRS Berhasil Dihapus');
    }
}
