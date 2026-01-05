<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'total',
        'diskon_total',
        'bayar',
        'kembalian',
        'metode_pembayaran',
        'kasir_id',
        'tanggal',
        'status'
    ];

    public function details()
    {
        return $this->hasMany(PenjualanDetail::class);
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }
}
