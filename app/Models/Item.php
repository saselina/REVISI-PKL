<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Nama tabel di database (asumsi nama tabel Anda adalah 'items')
    protected $table = 'items';

    // Kolom yang dapat diisi massal (Mass Assignable)
    // PASTIKAN SEMUA NAMA KOLOM INI SESUAI DENGAN SCHEMA DATABASE ANDA
    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'status',
        'ruangan',
        'gedung',
        // Jika Anda memiliki kolom lain seperti 'kode_aset', tambahkan di sini.
    ];
}
