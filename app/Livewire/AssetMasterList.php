<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;
use Illuminate\Support\Facades\Session;

class AssetMasterList extends Component
{
    use WithPagination;

    // MODAL PROPERTIES
    public $isOpen = false;       // Untuk Modal Detail
    public $isEditOpen = false;   // Untuk Modal Edit
    public $itemDetail = null;

    // FORM PROPERTIES (EDIT)
    public $selected_id, $kode_aset, $nama_barang, $kategori, $gedung, $lokasi, $status, $manufacture, $serial_number, $processor, $ram, $ssd, $hdd, $user;

    // FILTERS
    public $filterGedung = '';
    public $filterKategori = '';
    public $search = '';
    public $perPage = 15;

    protected $queryString = [
        'filterGedung' => ['except' => ''],
        'filterKategori' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    /** --- LOGIC DETAIL --- **/
    public function openModal($id)
    {
        $this->itemDetail = Item::find($id);
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isEditOpen = false;
        $this->itemDetail = null;
        $this->resetErrorBag();
    }

    /** --- LOGIC EDIT --- **/
    public function edit($id)
    {
        $item = Item::find($id);
        $this->selected_id = $id;
        $this->nama_barang = $item->nama_barang;
        $this->kode_aset = $item->kode_aset;
        $this->kategori = $item->kategori;
        $this->gedung = $item->gedung;
        $this->lokasi = $item->lokasi;
        $this->status = $item->status;
        $this->manufacture = $item->manufacture;
        $this->serial_number = $item->serial_number;
        $this->processor = $item->processor;
        $this->ram = $item->ram;
        $this->ssd = $item->ssd;
        $this->hdd = $item->hdd;
        $this->user = $item->user;

        $this->isEditOpen = true;
    }

    public function update()
    {
        $this->validate([
            'nama_barang' => 'required',
            'status' => 'required',
            'gedung' => 'required',
        ]);

        $item = Item::find($this->selected_id);
        $item->update([
            'nama_barang' => $this->nama_barang,
            'kode_aset' => $this->kode_aset,
            'kategori' => $this->kategori,
            'gedung' => $this->gedung,
            'lokasi' => $this->lokasi,
            'status' => $this->status,
            'manufacture' => $this->manufacture,
            'serial_number' => $this->serial_number,
            'processor' => $this->processor,
            'ram' => $this->ram,
            'ssd' => $this->ssd,
            'hdd' => $this->hdd,
            'user' => $this->user,
        ]);

        $this->isEditOpen = false;
        Session::flash('success', 'Aset berhasil diperbarui!');
    }

    public function resetFilter()
    {
        $this->filterGedung = ''; $this->filterKategori = ''; $this->search = '';
        $this->resetPage();
    }

    public function updating($property)
    {
        if (in_array($property, ['search', 'filterGedung', 'filterKategori'])) { $this->resetPage(); }
    }

    public function confirmDelete($id)
    {
        if ($item = Item::find($id)) {
            $item->delete();
            Session::flash('success', 'Aset berhasil dihapus!');
        }
        $this->resetPage();
    }

    public function render()
    {
        $searchTerm = trim($this->search);
        $query = Item::query()
            ->latest()
            ->when($this->filterGedung, fn ($q) => $q->where('gedung', $this->filterGedung))
            ->when($this->filterKategori, fn ($q) => $q->where('kategori', $this->filterKategori))
            ->when($searchTerm, function ($q) use ($searchTerm) {
                $q->where(function ($sub) use ($searchTerm) {
                    $sub->where('nama_barang', 'like', "%{$searchTerm}%")
                        ->orWhere('manufacture', 'like', "%{$searchTerm}%")
                        ->orWhere('lokasi', 'like', "%{$searchTerm}%")
                        ->orWhere('gedung', 'like', "%{$searchTerm}%");
                });
            });

        return view('livewire.asset-master-list', [
            'assets' => $query->paginate((int)$this->perPage),
            'listGedung' => Item::distinct()->whereNotNull('gedung')->pluck('gedung'),
            'countBarang' => Item::count(),
            'asetAktif' => Item::whereIn('status', ['aktif', 'active', 'baik', 'kurang baik'])->count(),
            'asetTidakAktif' => Item::whereNotIn('status', ['aktif', 'active', 'baik', 'kurang baik'])->count(),
            'totalUser' => \App\Models\User::count(),
        ]);
    }
}
