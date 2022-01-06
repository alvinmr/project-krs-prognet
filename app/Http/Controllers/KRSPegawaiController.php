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

    public function showTableKRS(Request $request)
    {
        $tahun_ajaran = TahunAjaran::all();
        if (!$request->tahun_ajaran_id) {
            $mahasiswa = Mahasiswa::whereHas('transaksi_krs', function ($query) {
                $query->where('status', '!=', 'disetujui')->where("tahun_ajaran_id", TahunAjaran::orderBy('id', 'desc')->first()->id);
            })->get();
        } else {
            $mahasiswa = Mahasiswa::whereHas('transaksi_krs', function ($query) use ($request) {
                $query->where('status', '!=', 'disetujui')->where("tahun_ajaran_id", $request->tahun_ajaran_id);
            })->get();
        }
        return view('pages.pegawai.krs.index', compact('mahasiswa', 'tahun_ajaran'));
    }

    public function showDetailMatakuliah($id)
    {
        $listMataKuliahs = Matakuliah::find($id);
        return view('pages.pegawai.krs.detail', compact('listMataKuliahs'));
    }

    public function showCreateTableKRS(Request $request)
    {

        $tahun_ajaran = TahunAjaran::all();
        if (!$request->tahun_ajaran_id) {
            $listMataKuliahs = Matakuliah::where("tahun_ajaran_id", TahunAjaran::orderBy('id', 'desc')->first()->id)->get();
        } else {
            $listMataKuliahs = Matakuliah::where("tahun_ajaran_id", $request->tahun_ajaran_id)->get();
        }
        return view("pages.pegawai.krs.create", compact('listMataKuliahs', 'tahun_ajaran'));
    }


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