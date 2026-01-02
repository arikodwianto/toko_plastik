<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang'; // WAJIB karena bukan plural bawaan Laravel

    protected $fillable = [
        'nama',
        'stok',
        'harga_modal',
        'harga_jual',
    ];

    public function stokMasuk()
    {
        return $this->hasMany(StokMasuk::class);
    }

    public function mutasi()
    {
        return $this->hasMany(MutasiStok::class);
    }

    public function opname()
    {
        return $this->hasMany(StokOpname::class);
    }
}
