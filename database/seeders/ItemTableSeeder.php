<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ItemTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('items')->truncate();

        // Nama file sudah disederhanakan
        $filesToImport = [
            'office.csv' => 'GEDUNG OFFICE',
            'service.csv' => 'GEDUNG SERVICE',
            'store.csv' => 'GEDUNG STORE',
        ];

        $path = database_path('seeders/csv/');
        $delimiters = [',', ';'];

        foreach ($filesToImport as $fileName => $gedungName) {
            $csvFile = $path . $fileName;

            if (!file_exists($csvFile)) {
                $this->command->error("❌ FILE TIDAK DITEMUKAN: $fileName. Pastikan file ada di database/seeders/csv/.");
                continue;
            }

            $imported = false;

            foreach ($delimiters as $delimiter) {
                if (($handle = fopen($csvFile, 'r')) === FALSE) {
                    continue;
                }

                // Lewati 3 baris header
                for ($i = 0; $i < 3; $i++) {
                    fgetcsv($handle, 0, $delimiter);
                }

                $data = [];
                $successCount = 0;

                while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE) {

                    // Konversi Encoding
                    $row = array_map(function ($value) {
                        return mb_convert_encoding($value, 'UTF-8', 'Windows-1252');
                    }, $row);

                    if (count($row) < 12) continue;

                    $itemData = [
                        'nama_barang' => $row[1] ?? null, 'jenis_barang' => $row[2] ?? null,
                        'type' => $row[3] ?? null, 'manufacture' => $row[4] ?? null,
                        'serial_number' => $row[5] ?? null, 'status' => $row[6] ?? 'Aktif',
                        'processor' => $row[7] ?? null, 'ram' => $row[8] ?? null,
                        'ssd' => $row[9] ?? null, 'hdd' => $row[10] ?? null,
                        'ruangan' => $row[11] ?? null, 'user' => $row[12] ?? null,
                        'gedung' => $gedungName,
                        'created_at' => now(), 'updated_at' => now(),
                    ];

                    $data[] = $itemData;
                    $successCount++;
                }
                fclose($handle);

                if (!empty($data)) {
                    DB::table('items')->insert($data);
                    $this->command->info("✅ Sukses impor $successCount baris data dari $fileName dengan delimiter '$delimiter'.");
                    $imported = true;
                    break;
                }
            }
            if (!$imported) {
                $this->command->warn("⚠️ Gagal membaca data dari $fileName menggunakan delimiter koma (,) maupun titik koma (;).");
            }
        }
    }
}
