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
    /* untuk searching list matakuliah yang dicari sama mahasiswa pake kode */ 
    public function search(Request $request) 
    {
        if ($request->ajax()) 
        {
            $output = "";
            $listMataKuliahs = DB::table('matakuliah')->where('kode', 'LIKE', '%'.$request->search."%")->get();
        }

        if ($listMataKuliahs) 
        {
            foreach($listMataKuliahs as $key => $listMataKuliah) 
            {
                $output.  '<tr>'.
                   '<td>'.$listMataKuliah->kode. '</td>'.
                   '<td>'.$listMataKuliah->nama_matakuliah. '</td>'.
                   '<td>'.$listMataKuliah->semester. '</td>'.
                   '<td>'.$listMataKuliah->jam_mulai. '</td>'.
                   '<td>'.$listMataKuliah->jam_selesai. '</td>'.
                   '<\tr>';
            }
        }
    }

    public function showTableKRS() 
    {
        /* $mahasiswas = auth('mahasiswa')->user()->id; */
        /* $listKRSs = TransaksiKrs::where('mahasiswa_id', '=', $mahasiswas)->get(); */ 
        $listKRSs = TransaksiKrs::all(); 
        return view('pages.pegawai.krs.index', compact('listKRSs'));
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
        $krs->semester= $matakuliah->semester;
        $krs->nilai= 'A';
        $krs->status= 'pending';
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
