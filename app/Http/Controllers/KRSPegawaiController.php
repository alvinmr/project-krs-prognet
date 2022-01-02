<?php

namespace App\Http\Controllers;

use App\Models\TransaksiKrs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\TahunAjaran;
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
        $krs->save();
        return redirect()->route('pegawai.krs-index')->with('success', 'KRS berhasil diapprove');
    }

    public function approveAll($id)
    {
        TransaksiKrs::whereMahasiswaId($id)->update([
            'status' => 'disetujui',
        ]);
        return redirect()->route('pegawai.krs-index')->with('success', 'KRS berhasil diapprove');
    }


    public function decline($id)
    {
        $krs = TransaksiKrs::find($id);
        $krs->status = 'ditolak';
        $krs->save();
        return redirect()->route('pegawai.krs-index')->with('success', 'KRS berhasil ditolak');
    }

    public function declineAll($id)
    {
        TransaksiKrs::whereMahasiswaId($id)->update([
            'status' => 'ditolak',
        ]);
        return redirect()->route('pegawai.krs-index')->with('success', 'KRS berhasil ditolak');
    }

    public function showTableKRS()
    {
        $mahasiswa = Mahasiswa::whereHas('transaksi_krs', function ($query) {
            $query->where('status', '!=', 'disetujui');
        })->get();
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
        $krs->nilai = 'Tunda';
        $krs->status = 'pending';
        $krs->mahasiswa_id = $id;

        $krs->save();
        return redirect()->route('pegawai.krs-index')->with('success', 'KRS Telah Ditambahkan');
    }

    public function storeDeleteTableKRS($id)
    {
        $krs = TransaksiKrs::where('id', $id)->delete();
        return redirect()->route('pegawai.krs-index')->with('success', 'Data KRS Berhasil Dihapus');
    }
}