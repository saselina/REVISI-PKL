<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ItemIndex extends Component
{
    use WithPagination;

    // FILTERS
    public $search = '';
    public $perPage = 10;

    // METRIK (Properti untuk menyimpan data statistik)
    public $totalAset = 0;
    public $totalUser = 0;
    public $asetAktif = 0;
    public $asetTidakAktif = 0;

    // QUERY STRING agar filter terbaca di URL
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->calculateMetrics();

        // Logika otomatis jika datang dari route laporan tertentu
        if (request()->routeIs('laporan.aktif')) {
            $this->search = 'Aktif';
        } elseif (request()->routeIs('laporan.nonaktif')) {
            $this->search = 'Tidak Aktif';
        }
    }

    /**
     * Menghitung statistik untuk Dashboard Card
     * Diupdate untuk kategori status yang lebih spesifik
     */
    protected function calculateMetrics()
    {
        $this->totalAset = Item::count();
        $this->totalUser = User::count();

        // Menghitung status Aktif (Aktif, Baik, Kurang Baik)
        $this->asetAktif = Item::whereIn('status', ['Aktif', 'Baik', 'Kurang Baik', 'active'])->count();

        // Menghitung status Tidak Aktif (Tidak Aktif, Rusak, Sudah Kusam)
        $this->asetTidakAktif = Item::whereIn('status', ['Tidak Aktif', 'Rusak', 'Sudah Kusam'])->count();
    }

    public function updating($property)
    {
        // Reset page kalau search atau jumlah data per halaman berubah
        if (in_array($property, ['search', 'perPage'])) {
            $this->resetPage();
        }
    }

    /**
     * Main Query Render
     */
    public function render()
    {
        $searchTerm = trim($this->search);

        $query = Item::query()
            ->latest()
            ->when($searchTerm, function ($q) use ($searchTerm) {
                $q->where(function ($sub) use ($searchTerm) {
                    $sub->where('nama_barang', 'like', "%{$searchTerm}%")
                        ->orWhere('manufacture', 'like', "%{$searchTerm}%")
                        ->orWhere('gedung', 'like', "%{$searchTerm}%")
                        ->orWhere('lokasi', 'like', "%{$searchTerm}%")
                        ->orWhere('kode_barang', 'like', "%{$searchTerm}%")
                        ->orWhere('status', 'like', "%{$searchTerm}%"); // Tambahan agar filter status juga berfungsi di pencarian
                });
            });

        return view('livewire.item-index', [
            'assets'         => $query->paginate((int)$this->perPage),
            'listGedung'     => Item::distinct()->whereNotNull('gedung')->pluck('gedung'),
            'countBarang'    => $this->totalAset,
            'totalUser'      => $this->totalUser,
            'asetAktif'      => $this->asetAktif,
            'asetTidakAktif' => $this->asetTidakAktif,
        ]);
    }

    // DELETE LOGIC ------------------------------------------------------

    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->dispatch('showDeleteConfirm');
    }

    public function deleteItem()
    {
        if ($item = Item::find($this->deleteId)) {
            $item->delete();
            Session::flash('success', 'Aset berhasil dihapus!');
        }

        $this->resetPage();
        // Refresh metrik agar angka di card update realtime setelah hapus
        $this->calculateMetrics();
    }
}
