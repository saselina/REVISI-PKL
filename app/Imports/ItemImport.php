<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow; // Import untuk melewati header

class ItemImport implements ToModel, WithStartRow
{
    private $gedungName;

    public function __construct(string $gedungName)
    {
        $this->gedungName = $gedungName;
    }

    /**
     * Tentukan baris mana data dimulai (untuk melewati 3 baris header)
     */
    public function startRow(): int
    {
        return 4;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Pastikan row memiliki data yang cukup (minimal 12 kolom untuk mapping)
        if (!isset($row[11])) {
            return null;
        }

        // Mapping berdasarkan index array $row (row[0] adalah kolom 'No' CSV)
        return new Item([
            'nama_barang' => $row[1] ?? null,        // Index 1
            'jenis_barang' => $row[2] ?? null,       // Index 2
            'type' => $row[3] ?? null,               // Index 3
            'manufacture' => $row[4] ?? null,        // Index 4
            'serial_number' => $row[5] ?? null,      // Index 5
            'status' => $row[6] ?? 'Aktif',          // Index 6
            'processor' => $row[7] ?? null,          // Index 7
            'ram' => $row[8] ?? null,                // Index 8
            'ssd' => $row[9] ?? null,                // Index 9
            'hdd' => $row[10] ?? null,               // Index 10
            'ruangan' => $row[11] ?? null,           // Index 11 (Loc.)
            'user' => $row[12] ?? null,              // Index 12 (User)
            'gedung' => $this->gedungName,           // Dari constructor
        ]);
    }
}
