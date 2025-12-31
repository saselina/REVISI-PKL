<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use Livewire\WithPagination;

class AssetActiveList extends Component
{
    use WithPagination;

    // Properti filter yang terhubung langsung ke input/select
    public $filterGedung = '';
    public $search = '';

    // Reset halaman saat filter berubah agar pencarian akurat
    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterGedung() { $this->resetPage(); }

    public function resetFilter()
    {
        $this->reset(['filterGedung', 'search']);
    }

    public function render()
    {
        $listGedung = ['Gedung Office', 'Gedung Service Center', 'Gedung Store'];

        // Data langsung ditarik secara otomatis (Reaktif)
        $assets = Item::query()
            ->whereIn('status', ['Aktif', 'active', 'Baik'])
            ->when($this->filterGedung, fn($q) => $q->where('gedung', $this->filterGedung))
            ->when($this->search, fn($q) => $q->where('nama_barang', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);

        return view('livewire.asset-active-list', [
            'assets' => $assets,
            'listGedung' => $listGedung
        ]);
    }
}
