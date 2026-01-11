<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPembelianExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($s) {
            return [
                'Tanggal' => $s->tanggal_masuk,
                'Barang' => $s->barang->nama,
                'Supplier' => $s->supplier ?? '-',
                'Jumlah' => $s->jumlah,
                'Total' => $s->jumlah * $s->barang->harga_modal,
            ];
        });
    }

    public function headings(): array
    {
        return ['Tanggal', 'Barang', 'Supplier', 'Jumlah', 'Total'];
    }
}
