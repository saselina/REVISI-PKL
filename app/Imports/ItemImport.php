<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ItemImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    /**
     * Karena sekarang baris judul cuma 1 baris (Header),
     * maka data dimulai dari baris ke-2.
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * Setting agar Laravel Excel tahu pembatasnya adalah titik koma (;)
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }

    /**
    * Mapping data berdasarkan urutan kolom CSV lu:
    * 0:No, 1:Nama Barang, 2:Kategori, 3:Kode Aset, 4:S/N,
    * 5:Gedung, 6:Lokasi, 7:Status, 8:User, 9:Type,
    * 10:Manufacture, 11:Processor, 12:Ram, 13:SSD, 14:HDD,
    * 15:Tgl Perolehan, 16:Nilai, 17:Umur Ekonomis
    */
    public function model(array $row)
    {
        // Lewati jika nama barang kosong
        if (!isset($row[1]) || empty($row[1])) {
            return null;
        }

        return new Item([
            'nama_barang'     => $row[1],
            'kategori'        => $row[2] ?? null,
            'kode_aset'       => $row[3] ?? null,
            'serial_number'   => $row[4] ?? null,
            'gedung'          => $row[5] ?? null, // Sekarang ambil langsung dari kolom CSV
            'lokasi'          => $row[6] ?? null, // Ganti dari ruangan ke lokasi
            'status'          => $row[7] ?? 'Aktif',
            'user'            => $row[8] ?? null,
            'type'            => $row[9] ?? null,
            'manufacture'     => $row[10] ?? null,
            'processor'       => $row[11] ?? null,
            'ram'             => $row[12] ?? null,
            'ssd'             => $row[13] ?? null,
            'hdd'             => $row[14] ?? null,
            'tanggal_perolehan' => $row[15] ?? null,
            'nilai_perolehan' => $this->cleanPrice($row[16] ?? 0),
            'umur_ekonomis'   => $row[17] ?? null,
        ]);
    }

    /**
     * Membersihkan format Rp atau titik ribuan
     */
    private function cleanPrice($value)
    {
        $clean = preg_replace('/[^0-9]/', '', $value);
        return (float) $clean ?: null;
    }
}
