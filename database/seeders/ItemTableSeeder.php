<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class ItemTableSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel sebelum import
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('items')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Daftar file yang akan diimport
        $filesToImport = [
          'Aset PT. Famili kita3.csv'
        ];

        $path = database_path('seeders/csv/');

        foreach ($filesToImport as $fileName) {
            $csvFile = $path . $fileName;

            if (!file_exists($csvFile)) {
                $this->command->error("❌ FILE TIDAK DITEMUKAN: $fileName");
                continue;
            }

            if (($handle = fopen($csvFile, 'r')) !== FALSE) {
                // Lewati baris pertama (Header) sesuai startRow() di ItemImport
                fgetcsv($handle, 0, ';');

                $data = [];
                $count = 0;

                while (($row = fgetcsv($handle, 0, ';')) !== FALSE) {
                    // Mapping berdasarkan urutan kolom CSV lu yang baru:
                    // 0:No, 1:Nama Barang, 2:Kategori, 3:Kode Aset, 4:S/N,
                    // 5:Gedung, 6:Lokasi, 7:Status, 8:User, 9:Type,
                    // 10:Manufacture, 11:Processor, 12:Ram, 13:SSD, 14:HDD,
                    // 15:Tgl Perolehan, 16:Nilai, 17:Umur Ekonomis

                    if (!isset($row[1]) || empty($row[1])) continue;

                    $data[] = [
                        'nama_barang'       => $row[1] ?? null,
                        'kategori'          => $row[2] ?? null,
                        'kode_aset'         => $row[3] ?? null,
                        'serial_number'     => $row[4] ?? null,
                        'gedung'            => $row[5] ?? null,
                        'lokasi'            => $row[6] ?? null,
                        'status'            => $row[7] ?? 'Aktif',
                        'user'              => $row[8] ?? null,
                        'type'              => $row[9] ?? null,
                        'manufacture'       => $row[10] ?? null,
                        'processor'         => $row[11] ?? null,
                        'ram'               => $row[12] ?? null,
                        'ssd'               => $row[13] ?? null,
                        'hdd'               => $row[14] ?? null,
                        'tanggal_perolehan' => $row[15] ?? null,
                        'nilai_perolehan'   => $this->cleanPrice($row[16] ?? 0),
                        'umur_ekonomis'     => $row[17] ?? null,
                        'created_at'        => now(),
                        'updated_at'        => now(),
                    ];

                    $count++;

                    // Batch insert per 100 baris biar kenceng
                    if (count($data) >= 100) {
                        DB::table('items')->insert($data);
                        $data = [];
                    }
                }

                // Sisa data insert
                if (!empty($data)) {
                    DB::table('items')->insert($data);
                }

                fclose($handle);
                $this->command->info("✅ Berhasil memproses $count data dari $fileName");
            }
        }
    }

    private function cleanPrice($value)
    {
        $clean = preg_replace('/[^0-9]/', '', $value);
        return (float) $clean ?: 0;
    }
}
