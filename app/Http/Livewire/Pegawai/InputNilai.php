<?php

namespace App\Http\Livewire\Pegawai;

use App\Models\TransaksiKrs;
use Livewire\Component;

class InputNilai extends Component
{
    public $dataNilai, $transaksi_krs, $nilai;

    public $isOpenMessage = false;

    public function mount()
    {
        $this->dataNilai = TransaksiKrs::getEnumKey('nilai');
        $this->nilai = $this->transaksi_krs->nilai;
    }

    public function render()
    {
        return view('livewire.pegawai.input-nilai');
    }

    public function storeNilai($id)
    {
        $this->isOpenMessage = true;
        TransaksiKrs::find($id)->update([
            'nilai' => $this->nilai
        ]);
        $this->emit('nilai-update');
    }
}