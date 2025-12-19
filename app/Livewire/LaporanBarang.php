<?php

namespace App\Livewire;

use Livewire\Component;

class LaporanBarang extends Component
{
    public function render()
    {
        return view('livewire.laporan-barang')
        ->layout('layouts.app');
    }
}
