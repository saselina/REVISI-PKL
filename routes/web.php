<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ItemIndex;
use App\Livewire\CreateItem;
use App\Livewire\EditItem;
use App\Http\Controllers\ProfileController;
use App\Models\Item;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Halaman login custom
Route::view('/login', 'livewire.pages.login')->name('login');

// Root langsung ke login
Route::redirect('/', '/login');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', ItemIndex::class)
        ->middleware('verified')
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // Detail item
    Route::get('/assets/{item}', function (Item $item) {
        return view('livewire.assets.detail', [
            'item' => $item
        ]);
    })->name('assets.detail');

    // Create item
    Route::get('/assets/create', CreateItem::class)
        ->name('assets.create');

    // Edit item
    Route::get('/assets/{item}/edit', EditItem::class)
        ->name('assets.edit');
});

require __DIR__.'/auth.php';
