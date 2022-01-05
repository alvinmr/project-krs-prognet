<?php

namespace App\Http\Livewire;

use App\Models\Matakuliah;
use App\Models\TahunAjaran;
use Livewire\Component;

class PaginateMatakuliah extends Component
{
    public $byTahunAjaran = 1; 
    public $search = null;
    public $matakuliah = null;
    
    public function updatePagination()
    {
        $this->resetPage();
    }
        
    public function render()
    {
        return view('pages.pegawai.matakuliah.index', [
            'tahun_ajaran'=>TahunAjaran::all(),
            'matakuliah'=>Matakuliah::where("tahun_ajaran_id", $this->tahun_ajaran_id);
        ]);
    }
}
