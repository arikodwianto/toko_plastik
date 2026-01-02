<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiStok extends Model
{
    protected $table = 'mutasi_stok';

    protected $fillable = [
        'item_id',
        'jumlah',
        'tipe',
        'keterangan',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
