<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use Livewire\WithPagination;

class LaporanBarang extends Component
{
    use WithPagination;

    public $filterGedung = '';
    public $filterKategori = '';
    public $showTable = false;

    /**
     * Menampilkan data tabel berdasarkan filter yang dipilih
     */
    public function tampilkan()
    {
        $this->showTable = true;
        $this->resetPage();
    }

    /**
     * Mereset semua filter dan menyembunyikan tabel
     */
    public function resetFilter()
    {
        $this->reset(['filterGedung', 'filterKategori', 'showTable']);
        $this->resetPage();
    }

    public function render()
    {
        // 1. Mendefinisikan daftar Gedung sesuai permintaan
        $listGedung = [
            'Gedung Office',
            'Gedung Service Center',
            'Gedung Store'
        ];

        // 2. Mendefinisikan daftar Kategori sesuai permintaan
        $listKategori = [
            'Furniture',
            'IT',
            'Elektronik',
            'Vehicle / Kendaraan',
            'Peralatan Kantor'
        ];

        // 3. Eksekusi Query jika tombol Tampilkan sudah diklik
        $assets = $this->showTable
            ? Item::query()
                ->when($this->filterGedung, fn($q) => $q->where('gedung', $this->filterGedung))
                ->when($this->filterKategori, fn($q) => $q->where('kategori', $this->filterKategori))
                ->latest()
                ->paginate(10)
            : collect();

        return view('livewire.laporan-barang', [
            'assets' => $assets,
            'listGedung' => $listGedung,
            'listKategori' => $listKategori
        ]);
    }
}
