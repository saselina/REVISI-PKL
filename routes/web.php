<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ItemIndex;
use App\Livewire\CreateItem;
use App\Livewire\EditItem;
use App\Livewire\AssetMasterList;
use App\Livewire\AssetActiveList;
use App\Livewire\AssetInactiveList;
use App\Livewire\LaporanBarang;
use App\Livewire\LaporanAktif;
use App\Livewire\LaporanNonAktif;
use App\Livewire\ManajemenUser;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController; // Tambahkan ini
use App\Models\Item;

// PUBLIC ROUTES
Route::view('/login', 'livewire.pages.login')->name('login');
Route::redirect('/', '/login');

// AUTHENTICATED ROUTES
Route::middleware(['auth'])->group(function () {

    // 1. DASHBOARD
    Route::get('/dashboard', ItemIndex::class)->name('dashboard');

    // 2. PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // 3. MASTER ASET
    Route::get('/assets', AssetMasterList::class)->name('assets.index');

    // --- TAMBAHKAN ROUTE INI UNTUK HANDLE IMPORT CSV ---
    Route::post('/assets/import', [ItemController::class, 'import'])->name('assets.import');

    Route::get('/assets/create', CreateItem::class)->name('assets.create');
    Route::get('/assets/active', AssetActiveList::class)->name('assets.active');
    Route::get('/assets/inactive', AssetInactiveList::class)->name('assets.inactive');

    // 4. LAPORAN
    Route::get('/laporan/barang', LaporanBarang::class)->name('laporan.barang');
    Route::get('/laporan/aktif', LaporanAktif::class)->name('laporan.aktif');
    Route::get('/laporan/non-aktif', LaporanNonAktif::class)->name('laporan.nonaktif');

    // 5. SISTEM
    Route::get('/manajemen-user', ManajemenUser::class)->name('users.index');

    // 6. DETAIL & EDIT
    Route::get('/assets/{item}', function (Item $item) {
        return view('livewire.assets.detail', ['item' => $item]);
    })->name('assets.detail');

    Route::get('/assets/{item}/edit', EditItem::class)->name('assets.edit');
});

require __DIR__.'/auth.php';
