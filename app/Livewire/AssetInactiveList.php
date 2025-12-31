<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use Livewire\WithPagination;

class AssetInactiveList extends Component
{
    use WithPagination;

    public $filterGedung = '';
    public $search = '';

    // Reset halaman saat filter berubah agar pencarian tetap akurat
    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterGedung() { $this->resetPage(); }

    public function resetFilter()
    {
        $this->reset(['filterGedung', 'search']);
    }

    public function render()
    {
        $listGedung = ['Gedung Office', 'Gedung Service Center', 'Gedung Store'];

        // Query otomatis hanya untuk data TIDAK AKTIF
        $assets = Item::query()
            ->whereIn('status', ['Tidak Aktif', 'Rusak', 'Sudah Kusam', 'inactive'])
            ->when($this->filterGedung, fn($q) => $q->where('gedung', $this->filterGedung))
            ->when($this->search, fn($q) => $q->where('nama_barang', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);

        return view('livewire.asset-inactive-list', [
            'assets' => $assets,
            'listGedung' => $listGedung
        ]);
    }
}
