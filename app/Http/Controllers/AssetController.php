<?php

namespace App\Http\Controllers;

use App\Models\Item; // <-- BARIS INI YANG MENGHILANGKAN MERAH!
use Illuminate\Http\Request;

class AssetController extends Controller
{
    
    public function show(Item $item)
    {
        return view('assets.detail', [
            'item' => $item,
        ]);
    }

    public function edit(Item $item)
    {
        return view('assets.edit', [
            'item' => $item,
        ]);
    }
}
