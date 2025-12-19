<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Dipertahankan
use App\Models\Item;
use Illuminate\Support\Facades\Session; // Digunakan untuk flash message

class AssetMasterList extends Component
{
    use WithPagination;

    // FILTERS (Dipindahkan dari ItemIndex)
    public $filterGedung = '';
    public $filterKategori = '';
    public $search = '';
    public $perPage = 15; // Tambahkan perPage untuk pagination

    // QUERY STRING (Dipindahkan dari ItemIndex)
    protected $queryString = [
        'filterGedung' => ['except' => ''],
        'filterKategori' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    // Hapus mount() dan calculateMetrics() (karena hanya Dashboard yang butuh)

    /**
     * Reset semua filter (Dipindahkan dari ItemIndex)
     */
    public function resetFilter()
    {
        $this->filterGedung   = '';
        $this->filterKategori = '';
        $this->search         = '';
        $this->resetPage();
    }

    /**
     * Reset pagination setiap kali ada filter berubah (Dipindahkan dari ItemIndex)
     */
    public function updating($property)
    {
        if (in_array($property, ['search', 'filterGedung', 'filterKategori', 'perPage'])) {
            $this->resetPage();
        }
    }

    /**
     * Main Query Render (Dipindahkan dan Ditingkatkan)
     */
    public function render()
{
    $searchTerm = trim($this->search);

    $query = Item::query()
        ->latest()
        ->when($this->filterGedung, fn ($q) =>
            $q->where('gedung', $this->filterGedung)
        )
        ->when($searchTerm, function ($q) use ($searchTerm) {
            $q->where(function ($sub) use ($searchTerm) {
                // Mencari di kolom nama_barang saja
                $sub->where('nama_barang', 'like', "%{$searchTerm}%")
                    // Mencari di kolom manufacture saja
                    ->orWhere('manufacture', 'like', "%{$searchTerm}%")
                    // MENCARI GABUNGAN (Nama Barang + Manufacture)
                    ->orWhereRaw("CONCAT(nama_barang, ' ', manufacture) LIKE ?", ["%{$searchTerm}%"])
                    // Mencari di lokasi
                    ->orWhere('ruangan', 'like', "%{$searchTerm}%")
                    ->orWhere('gedung', 'like', "%{$searchTerm}%");
            });
        });

    return view('livewire.asset-master-list', [
        'assets'     => $query->paginate((int)$this->perPage),
        'listGedung' => Item::distinct()->whereNotNull('gedung')->pluck('gedung'),
    ]);
}

    // DELETE LOGIC (Dipindahkan dari ItemIndex) ---------------------------

    public $deleteId;

    public function confirmDelete($id)
    {
        $this->deleteId = $id;

        // Trigger JS modal di Blade
        $this->dispatch('showDeleteConfirm');
    }

    public function deleteItem()
    {
        // Pastikan Item ditemukan sebelum dihapus
        if ($item = Item::find($this->deleteId)) {
            $item->delete();
            Session::flash('message', 'Aset berhasil dihapus!');
        }

        $this->resetPage();
    }
}
