<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        // View dipanggil dengan nama 'livewire.profile.edit'
        // Data dilewatkan sebagai array pada ARGUMEN KEDUA
        return view('livewire.profile.edit', [
            'user' => $request->user(),
        ]);
    }
}
