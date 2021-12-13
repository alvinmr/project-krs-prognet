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
    public function storeKRS($id) 
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

    public function approve($id)
    {
        $krs = TransaksiKrs::find($id);
        $krs->status = 'disetujui'; 

        $krs->update();

        return redirect()->route('pegawai.krs-index')->with('status', 'Data KRS Mahasiswa Berhasil Disetujui');
    }

    public function showEditTableKRS($id) 
    {
        $krs = TransaksiKrs::find($id);

        $formdata = [
            'tahun_ajaran' => ['text', "Tahun Ajaran"],
            'semester' => ['text', "semester", ],
            'nilai' => ['text', "Nilai", ['A', 'B+', 'B', 'C+', 'D+', 'D', 'E']],
            'status' => ['text', "Status", ['disetujui', 'ditolak', 'pending']],
            'matakuliah_id' => ['int', "Matakuliah"],
            'mahasiswa_id' => ['int', "Mahasiswa"],
        ];

        return view('pages.pegawai.krs.edit', compact('krs', 'formdata'));
    }

    public function saveEdit(Request $request, $id)
    {
        /* $request->view(); */
        $krs = TransaksiKrs::find($id);

        $krs->tahun_ajaran = $request->input('tahun_ajaran');
        $krs->semester = $request->input('semester');
        $krs->nilai = $request->input('nilai');
        $krs->status = $request->input('status');
        $krs->matakuliah_id = $request->input('mahasiswa_id');
        $krs->mahasiswa_id= $request->input('mahasiswa_id');

        $krs->update();

        return redirect()->route('pegawai.krs-index')->with('status', 'Data KRS Mahasiswa Berhasil Disunting');
    }

    public function storeDeleteTableKRS($id) 
    {
        $krs = TransaksiKrs::where('id', $id)->delete();
        return redirect()->route('pegawai.krs-index')->with('status', 'Data KRS Berhasil Dihapus');
    }
}
