<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use Livewire\WithPagination;

class LaporanAktif extends Component
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
        // Daftar Gedung dan Kategori sesuai permintaan Anda
        $listGedung = ['Gedung Office', 'Gedung Service Center', 'Gedung Store'];
        $listKategori = ['Furniture', 'IT', 'Elektronik', 'Vehicle / Kendaraan', 'Peralatan Kantor'];

        // Query: Hanya mengambil status Aktif, Baik, Kurang Baik
        $assets = $this->showTable
            ? Item::query()
                ->whereIn('status', ['Aktif', 'Baik', 'Kurang Baik', 'active'])
                ->when($this->filterGedung, fn($q) => $q->where('gedung', $this->filterGedung))
                ->when($this->filterKategori, fn($q) => $q->where('kategori', $this->filterKategori))
                ->latest()
                ->paginate(10)
            : collect();

        return view('livewire.laporan-aktif', [
            'assets' => $assets,
            'listGedung' => $listGedung,
            'listKategori' => $listKategori
        ]);
    }
}
