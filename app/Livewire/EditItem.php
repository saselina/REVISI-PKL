<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class EditItem extends Component
{
    public Item $item;

    public $nama_barang;
    public $kategori;
    public $jenis_barang;
    public $type;
    public $manufacture;
    public $sn;
    public $status;
    public $proc;
    public $ram;
    public $ssd;
    public $hdd;
    public $ruangan;
    public $gedung;
    public $user;

    public $statusMessage = '';

    public $statusOptions = ['Aktif','Tidak Aktif','Rusak','Perawatan'];

    protected $rules = [
        'nama_barang'   => 'required|string|max:255',
        'kategori'      => 'nullable|string|max:255',
        'jenis_barang'  => 'nullable|string|max:255',
        'type'          => 'nullable|string|max:255',
        'manufacture'   => 'nullable|string|max:255',
        'sn'            => 'nullable|string|max:255',
        // PERBAIKAN VALIDASI: Menghapus spasi yang tidak perlu
        'status'        => 'required|in:Aktif,Tidak Aktif,Rusak,Perawatan',
        'proc'          => 'nullable|string|max:255',
        'ram'           => 'nullable|string|max:255',
        'ssd'           => 'nullable|string|max:255',
        'hdd'           => 'nullable|string|max:255',
        'ruangan'       => 'nullable|string|max:255',
        'gedung'        => 'nullable|string|max:255',
        'user'          => 'nullable|string|max:255',
    ];

    public function mount(Item $item)
    {
        $this->item = $item;

        // ISI SEMUA FIELD DARI DATABASE
        $this->nama_barang  = $item->nama_barang;
        $this->kategori     = $item->kategori;
        $this->jenis_barang = $item->jenis_barang;
        $this->type         = $item->type;
        $this->manufacture  = $item->manufacture;
        $this->sn           = $item->sn;
        $this->status       = $item->status;
        $this->proc         = $item->proc;
        $this->ram          = $item->ram;
        $this->ssd          = $item->ssd;
        $this->hdd          = $item->hdd;
        $this->ruangan      = $item->ruangan;
        $this->gedung       = $item->gedung;
        $this->user         = $item->user;
    }

    public function update()
    {
        $this->validate();

        try {
            $this->item->update([
                'nama_barang'   => $this->nama_barang,
                'kategori'      => $this->kategori,
                'jenis_barang'  => $this->jenis_barang,
                'type'          => $this->type,
                'manufacture'   => $this->manufacture,
                'sn'            => $this->sn,
                'status'        => $this->status,
                'proc'          => $this->proc,
                'ram'           => $this->ram,
                'ssd'           => $this->ssd,
                'hdd'           => $this->hdd,
                'ruangan'       => $this->ruangan,
                'gedung'        => $this->gedung,
                'user'          => $this->user,
            ]);

            // ✅ INI PERINTAH UNTUK REDIRECT KE MENU UTAMA (/dashboard)
            return $this->redirect('/dashboard', navigate: true);

        } catch (\Exception $e) {
            $this->statusMessage = 'Gagal menyimpan perubahan. Pastikan semua kolom yang diperlukan terisi dengan benar.';
            // Untuk debugging, Anda bisa menampilkan error: $this->statusMessage = 'Gagal menyimpan perubahan: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.assets.edit')
            ->layout('layouts.clean', [
                'title' => 'Edit Barang'
            ]);
    }
}
