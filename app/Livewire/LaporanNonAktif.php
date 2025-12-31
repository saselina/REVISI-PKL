<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use Livewire\WithPagination;

class LaporanNonAktif extends Component
{
    use WithPagination;

    public $filterGedung = '';
    public $filterKategori = '';
    public $showTable = false;

    public function tampilkan()
    {
        $this->showTable = true;
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->reset(['filterGedung', 'filterKategori', 'showTable']);
        $this->resetPage();
    }

    public function render()
    {
        $listGedung = ['Gedung Office', 'Gedung Service Center', 'Gedung Store'];
        $listKategori = ['Furniture', 'IT', 'Elektronik', 'Vehicle / Kendaraan', 'Peralatan Kantor'];

        // QUERY: Hanya mengambil status Tidak Aktif, Rusak, atau Sudah Kusam
        $assets = $this->showTable
            ? Item::query()
                ->whereIn('status', ['Tidak Aktif', 'Rusak', 'Sudah Kusam'])
                ->when($this->filterGedung, fn($q) => $q->where('gedung', $this->filterGedung))
                ->when($this->filterKategori, fn($q) => $q->where('kategori', $this->filterKategori))
                ->latest()
                ->paginate(10)
            : collect();

        return view('livewire.laporan-non-aktif', [
            'assets' => $assets,
            'listGedung' => $listGedung,
            'listKategori' => $listKategori
        ]);
    }
}
