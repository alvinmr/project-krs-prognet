<?php

namespace App\Http\Livewire;

use App\Models\Matakuliah;
use Livewire\Component;

class PaginateMatakuliah extends Component
{
    public $tahun_ajaran = null;

    public searchMatakuliah($query, $ )
    {

    } 

    public function render()
    {
        return view('livewire.paginate-matakuliah');
    }
}
