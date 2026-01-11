<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Barang;
use App\Models\PenjualanDetail;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();

        $totalJenisBarang = Barang::count();

        $totalStok = Barang::sum('stok');

        $totalModal = Barang::selectRaw(
            'SUM(stok * harga_modal) as total'
        )->value('total');

        $totalKeuntungan = PenjualanDetail::join(
        'barang',
        'penjualan_details.barang_id',
        '=',
        'barang.id'
    )
    ->selectRaw(
        'SUM((penjualan_details.harga - barang.harga_modal) * penjualan_details.qty) as total'
    )
    ->value('total');
        return view('owner.dashboard', compact(
            'totalUser',
            'totalJenisBarang',
            'totalStok',
            'totalModal',
            'totalKeuntungan'
        ));
    }
}
