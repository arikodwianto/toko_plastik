<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Plastik PE 1 Kg', 'stok' => 50, 'harga_modal' => 15000, 'harga_jual' => 20000],
            ['nama' => 'Plastik PP 1 Kg', 'stok' => 45, 'harga_modal' => 16000, 'harga_jual' => 21000],
            ['nama' => 'Plastik HD 1 Kg', 'stok' => 40, 'harga_modal' => 17000, 'harga_jual' => 22000],
            ['nama' => 'Kantong Kresek Hitam', 'stok' => 100, 'harga_modal' => 5000, 'harga_jual' => 8000],
            ['nama' => 'Kantong Kresek Putih', 'stok' => 120, 'harga_modal' => 5500, 'harga_jual' => 8500],
            ['nama' => 'Plastik Mika', 'stok' => 30, 'harga_modal' => 12000, 'harga_jual' => 17000],
            ['nama' => 'Plastik Vacuum', 'stok' => 25, 'harga_modal' => 20000, 'harga_jual' => 26000],
            ['nama' => 'Plastik Roll Besar', 'stok' => 15, 'harga_modal' => 30000, 'harga_jual' => 38000],
            ['nama' => 'Plastik Roll Kecil', 'stok' => 20, 'harga_modal' => 18000, 'harga_jual' => 24000],
            ['nama' => 'Plastik Es Batu', 'stok' => 80, 'harga_modal' => 7000, 'harga_jual' => 11000],
        ];

        foreach ($data as $item) {
            Barang::create($item);
        }
    }
}
