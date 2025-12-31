<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'kode_aset',
        'nama_barang',
        'jenis_barang',
        'kategori',         // Sudah ada
        'status',
        'gedung',
        'lokasi',
        'tanggal_perolehan',  // Ditambahkan
        'nilai_perolehan',  // Ditambahkan
        'umur_ekonomis',    // Ditambahkan
        'type',
        'manufacture',
        'serial_number',
        'processor',
        'ssd',
        'hdd',
        'user',
    ];
}
