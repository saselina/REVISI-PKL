<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar semua aset.
     */
    public function index()
    {
        // Ambil semua data dari tabel 'items'
        $items = Item::all();

        // Kirim data ke view 'items.index'
        return view('items.index', compact('items'));
    }
}
