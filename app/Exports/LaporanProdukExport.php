<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanProdukExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($p) {
            return [
                'Produk' => $p->barang->nama,
                'Total Terjual' => $p->total_terjual,
                'Omzet' => $p->omzet,
            ];
        });
    }

    public function headings(): array
    {
        return ['Produk', 'Total Terjual', 'Omzet'];
    }
}
