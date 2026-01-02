<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    protected $table = 'stok_opname';

    protected $fillable = [
        'item_id',
        'stok_sistem',
        'stok_fisik',
        'selisih',
        'tanggal_opname',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
