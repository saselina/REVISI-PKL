<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('jenis_barang')->nullable();
            $table->string('status')->default('Aktif');
            $table->string('ruangan')->nullable();
            $table->string('type')->nullable();
            $table->string('manufacture')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('processor')->nullable();
            $table->string('ram')->nullable();
            $table->string('ssd')->nullable();
            $table->string('hdd')->nullable();
            $table->string('gedung')->nullable();
            $table->string('user')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
