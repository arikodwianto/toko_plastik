<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{
    protected $table = 'stok_masuk';

    protected $fillable = [
        'item_id',
        'jumlah',
        'supplier',
        'harga_modal',
        'tanggal_masuk',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
