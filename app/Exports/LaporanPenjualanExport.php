<?php

namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPenjualanExport implements FromCollection, WithHeadings
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
                'Tanggal' => $p->tanggal,
                'Kode Transaksi' => $p->kode_transaksi,
                'Kasir' => $p->kasir->name ?? '-',
                'Total' => $p->total,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Kode Transaksi',
            'Kasir',
            'Total',
        ];
    }
}
