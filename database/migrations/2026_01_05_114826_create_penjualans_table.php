<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->dateTime('tanggal');
            $table->decimal('total', 15, 2);
            $table->decimal('diskon_total', 15, 2)->default(0);
            $table->decimal('bayar', 15, 2);
            $table->decimal('kembalian', 15, 2);
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'qris']);
            $table->foreignId('kasir_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
