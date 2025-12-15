<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;

class ItemIndex extends Component
{
    use WithPagination;

    // FILTERS
    public $filterGedung = '';
    public $filterKategori = '';
    public $search = '';

    // METRIK
    public $totalAset = 0;
    public $totalGedung = 0;
    public $barangMasuk = 0;
    public $barangKeluar = 0;

    // QUERY STRING
    protected $queryString = [
        'filterGedung' => ['except' => ''],
        'filterKategori' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->calculateMetrics();
    }

    /**
     * Hitung metrik untuk dashboard mini di halaman index
     */
    protected function calculateMetrics()
    {
        $this->totalAset     = Item::count();
        $this->totalGedung   = Item::distinct('gedung')->count('gedung');

        // Dummy placeholder → ganti saat ada tabel transaksi
        $this->barangMasuk   = 15;
        $this->barangKeluar  = 3;
    }

    /**
     * Reset semua filter
     */
    public function resetFilter()
    {
        $this->filterGedung   = '';
        $this->filterKategori = '';
        $this->search         = '';
        $this->resetPage();
    }

    /**
     * Reset pagination setiap kali ada filter berubah
     */
    public function updating($property)
    {
        if (in_array($property, ['search', 'filterGedung', 'filterKategori'])) {
            $this->resetPage();
        }
    }

    /**
     * Main Query Render
     */
    public function render()
    {
        $query = Item::query()

            // Filter gedung
            ->when($this->filterGedung, fn ($q) =>
                $q->where('gedung', $this->filterGedung)
            )

            // Filter kategori dari 2 kemungkinan column
            ->when($this->filterKategori, fn ($q) =>
                $q->where(fn ($sub) =>
                    $sub->where('kategori', $this->filterKategori)
                        ->orWhere('category', $this->filterKategori)
                )
            )

            // Searching
            ->when($this->search, fn ($q) =>
                $q->where(fn ($sub) =>
                    $sub->where('nama_barang', 'like', "%{$this->search}%")
                        ->orWhere('ruangan', 'like', "%{$this->search}%")
                        ->orWhere('kode_barang', 'like', "%{$this->search}%")
                )
            );

        return view('livewire.item-index', [
            'assets'      => $query->paginate(15),
            'listGedung'  => Item::distinct()->pluck('gedung'),
        ]);
    }

    // DELETE LOGIC ------------------------------------------------------

    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        // Trigger JS modal di Blade
        $this->dispatch('showDeleteConfirm');
    }

    public function deleteItem()
    {
        Item::findOrFail($this->deleteId)->delete();

        session()->flash('message', 'Aset berhasil dihapus!');
        $this->resetPage();

        // Refresh metrik agar dashboard mini update realtime
        $this->calculateMetrics();
    }
}
