<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mutasi_stok', function (Blueprint $table) {
            $table->id();

            $table->foreignId('barang_id')
                  ->constrained('barang')
                  ->cascadeOnDelete();

            $table->integer('jumlah');

            // masuk / keluar / opname
            $table->enum('tipe', ['masuk', 'keluar', 'opname']);

            $table->string('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mutasi_stok');
    }
};


