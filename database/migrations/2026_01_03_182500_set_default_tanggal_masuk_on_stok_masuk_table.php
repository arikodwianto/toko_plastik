<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('stok_masuk', function (Blueprint $table) {
        $table->timestamp('tanggal_masuk')
              ->default(DB::raw('CURRENT_TIMESTAMP'))
              ->change();
    });
}

public function down(): void
{
    Schema::table('stok_masuk', function (Blueprint $table) {
        $table->timestamp('tanggal_masuk')->change();
    });
}
};
