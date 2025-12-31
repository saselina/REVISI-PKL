<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use Illuminate\Support\Facades\Session;

class CreateItem extends Component
{
    public $nama_barang, $kategori, $gedung, $lokasi, $manufacture;

    protected $rules = [
        'nama_barang' => 'required|min:3',
        'kategori'    => 'required',
        'gedung'      => 'required',
        'lokasi'      => 'required',
        'manufacture' => 'required',
    ];

    public function save()
    {
        $this->validate();

        Item::create([
            'nama_barang' => $this->nama_barang,
            'kategori'    => $this->kategori,
            'gedung'      => $this->gedung,
            'lokasi'      => $this->lokasi,
            'manufacture' => $this->manufacture,
            'status'      => 'Baik',
        ]);

        Session::flash('success', 'Aset berhasil ditambahkan!');
        return redirect()->route('assets.index');
    }

    public function render()
    {
        return view('livewire.create-item', [
            'categories' => Item::whereNotNull('kategori')->distinct()->pluck('kategori'),
            'buildings'  => Item::whereNotNull('gedung')->distinct()->pluck('gedung'),
            'locations'  => Item::whereNotNull('lokasi')->distinct()->pluck('lokasi'),
        ]);
    }
}
