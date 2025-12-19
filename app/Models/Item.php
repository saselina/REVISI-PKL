<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'nama_barang',
        'kategori',      // ADDED
        'jenis_barang',
        'type',          // ADDED
        'manufacture',   // ADDED
        'sn',            // ADDED
        'status',
        'proc',          // ADDED
        'ram',           // ADDED
        'ssd',           // ADDED
        'hdd',           // ADDED
        'ruangan',
        'gedung',
        'user',          // ADDED
    ];
}
