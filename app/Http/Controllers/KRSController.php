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
        $listKRSs = TransaksiKrs::all(); 
        return view('pages.mahasiswa.krs.index', compact('listKRSs'));
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

        $krs->matakuliah_id = $matakuliah->id;
        $krs->tahun_ajaran = '2021';
        $krs->semester= $matakuliah->semester;
        $krs->nilai= 'A';
        $krs->status= 'pending';
        /* ni masi belum nemu cara dapetin id dari authnya */
        $krs->mahasiswa_id = '1';

        /* simpan semua penambahan data */
        $krs->save();
        return redirect()->route('mahasiswa.krs-index')->with('status', 'KRS Telah Ditambahkan');
    }

    public function showEditTableKRS() 
    {
        return view("pages.mahasiswa.krs.edit");
    }

    public function storeEditTableKRS() 
    {
        return view("pages.mahasiswa.krs.edit");
    }

    public function showDeleteTableKRS() 
    {
        return view("pages.mahasiswa.krs.delete");
    }

    public function storeDeleteTableKRS($id) 
    {
        $krs = TransaksiKrs::where('id', $id)->delete();
        return redirect()->route('mahasiswa.krs-index')->with('status', 'Data KRS Berhasil Dihapus');
    }
}

