<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;
use App\Models\User;

class ItemIndex extends Component
{
    use WithPagination;

    // FILTERS

    public $search = '';

    // METRIK
    public $totalAset = 0;
    public $perPage = 10; // Untuk dropdown "Tampilkan data"

    public $totalUser = 0;

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
    protected function calculateMetrics()
    {
        $this->totalAset = Item::count();
        $this->totalUser = User::count(); // Ambil data user asli dari DB
    }


    public function updating($property)
    {
        // Reset page kalau search atau jumlah data per halaman berubah
        if (in_array($property, ['search', 'perPage'])) {
            $this->resetPage();
        }
        if (request()->routeIs('laporan.aktif')) {
        $this->search = 'Aktif'; // Atau filter status = aktif
    } elseif (request()->routeIs('laporan.nonaktif')) {
        $this->search = 'Tidak Aktif';
    }
    }
    /**
     * Main Query Render
     */
    public function render()
{
    $query = Item::query()
        ->latest()
        ->when($this->search, fn ($q) =>
            $q->where(fn ($sub) =>
                $sub->where('nama_barang', 'like', "%{$this->search}%")
                    ->orWhere('ruangan', 'like', "%{$this->search}%")
                    ->orWhere('kode_barang', 'like', "%{$this->search}%")
            )
        );

    return view('livewire.item-index', [
        // Force the value to be an integer
        'assets' => $query->paginate((int)$this->perPage),

        'listGedung'     => Item::distinct()->pluck('gedung'),
        'countBarang'    => Item::count(),
        'totalUser'      => User::count(),
        'asetAktif'      => Item::where('status', 'regexp', 'aktif|active')->count(),
        'asetTidakAktif' => Item::where('status', 'like', '%Tidak Aktif%')->count(),
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
