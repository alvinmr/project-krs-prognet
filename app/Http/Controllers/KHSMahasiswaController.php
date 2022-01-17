<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use App\Models\TransaksiKrs;
use PDF;
use Illuminate\Http\Request;

class KHSMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $jumlahSks = 20;

    public function index(Request $request)
    {
        if (!$request->tahun_ajaran_id) {
            $khs = auth('mahasiswa')->user()->transaksi_krs->where('tahun_ajaran_id', auth('mahasiswa')->user()->getLastTahunAjaran());
        } else {
            $khs = auth('mahasiswa')->user()->transaksi_krs->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        }
        $tahun_ajaran = TahunAjaran::limit(auth('mahasiswa')->user()->semester)->get();
        return view('pages.mahasiswa.khs.index', compact('khs', 'tahun_ajaran'));
    }

    public function printKHS(Request $request)
    {
        if (isset(auth('mahasiswa')->user()->ipk)) {
            if (auth('mahasiswa')->user()->ipk > 0.00 && auth('mahasiswa')->user()->ipk <= 1.49) {
                $this->jumlahSks = 12;
            } else if (auth('mahasiswa')->user()->ipk >= 1.50 && auth('mahasiswa')->user()->ipk <= 1.99) {
                $this->jumlahSks = 15;
            } else if (auth('mahasiswa')->user()->ipk >= 2.00 && auth('mahasiswa')->user()->ipk <= 2.49) {
                $this->jumlahSks = 18;
            } else if (auth('mahasiswa')->user()->ipk >= 2.50 && auth('mahasiswa')->user()->ipk <= 2.99) {
                $this->jumlahSks = 21;
            } else if (auth('mahasiswa')->user()->ipk >= 3.00 && auth('mahasiswa')->user()->ipk <= 4.00) {
                $this->jumlahSks = 24;
            }
        }
        $tahun_ajaran = TahunAjaran::limit(auth('mahasiswa')->user()->semester)->get();
        $jumlahSks = $this->jumlahSks;

        if (!$request->tahun_ajaran_id) {
            $khs = auth('mahasiswa')->user()->transaksi_krs->where('tahun_ajaran_id', auth('mahasiswa')->user()->getLastTahunAjaran());
        } else {
            $khs = auth('mahasiswa')->user()->transaksi_krs->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        }

        $file_PDF = PDF::loadview('pages.mahasiswa.khs.pdf', compact('khs', 'tahun_ajaran', 'jumlahSks'));

        return $file_PDF->download('KHS - ' . auth('mahasiswa')->user()->nim . '.pdf');
    }
}