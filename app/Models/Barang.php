<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama',
        'stok',
        'harga_modal',
        'harga_jual',
    ];

    /**
     * Auto generate kode barang
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($barang) {
            $lastBarang = self::orderBy('id', 'desc')->first();

            if ($lastBarang && $lastBarang->kode_barang) {
                $lastKode = intval(substr($lastBarang->kode_barang, 4));
                $barang->kode_barang = 'BRG-' . str_pad($lastKode + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $barang->kode_barang = 'BRG-0001';
            }
        });
    }

    /**
     * ACCESSOR: hitung margin otomatis
     * margin = harga jual - harga modal
     */
    public function getMarginAttribute()
    {
        return $this->harga_jual - $this->harga_modal;
    }

    /**
     * (Opsional) margin dalam persen
     */
    public function getMarginPersenAttribute()
    {
        if ($this->harga_modal == 0) {
            return 0;
        }

        return round(
            (($this->harga_jual - $this->harga_modal) / $this->harga_modal) * 100,
            2
        );
    }
     public function getStokMenipisAttribute()
    {
        return $this->stok < 5;
    }
    public function penjualanDetails()
{
    return $this->hasMany(PenjualanDetail::class);
}

}
