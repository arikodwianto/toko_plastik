<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\StokMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanPenjualanExport;
use App\Exports\LaporanPembelianExport;
use App\Exports\LaporanProdukExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Barang;

use Barryvdh\DomPDF\Facade\Pdf;



class LaporanController extends Controller
{
    /**
     * ===============================
     * 1️⃣ LAPORAN PENJUALAN
     * Harian / Mingguan / Bulanan
     * ===============================
     */
    public function penjualan(Request $request)
    {
        $query = Penjualan::where('status', 'selesai');

        if ($request->filter === 'harian' && $request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filter === 'mingguan') {
            $query->whereBetween('tanggal', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        }

        if ($request->filter === 'bulanan' && $request->bulan) {
            $query->whereMonth('tanggal', substr($request->bulan, 5, 2))
                  ->whereYear('tanggal', substr($request->bulan, 0, 4));
        }

        $penjualans = $query->orderByDesc('tanggal')->get();

        return view('owner.laporan.penjualan', [
            'penjualans' => $penjualans,
            'totalTransaksi' => $penjualans->count(),
            'totalPenjualan' => $penjualans->sum('total'),
        ]);
    }

    /**
     * ===============================
     * 2️⃣ LAPORAN PEMBELIAN (STOK MASUK)
     * ===============================
     */
    public function pembelian(Request $request)
    {
        $stokMasuk = StokMasuk::with('barang')
            ->when($request->tanggal, function ($q) use ($request) {
                $q->whereDate('tanggal_masuk', $request->tanggal);
            })
            ->orderByDesc('tanggal_masuk')
            ->get();

        $totalPembelian = $stokMasuk->sum(function ($item) {
            return $item->jumlah * $item->barang->harga_modal;
        });

        return view('owner.laporan.pembelian', compact(
            'stokMasuk',
            'totalPembelian'
        ));
    }

    /**
     * ===============================
     * 3️⃣ LAPORAN KEUNTUNGAN (LABA)
     * ===============================
     */
    public function keuntungan(Request $request)
    {
        $details = PenjualanDetail::with('barang', 'penjualan')
            ->whereHas('penjualan', function ($q) {
                $q->where('status', 'selesai');
            })
            ->when($request->bulan, function ($q) use ($request) {
                $q->whereHas('penjualan', function ($p) use ($request) {
                    $p->whereMonth('tanggal', substr($request->bulan, 5, 2))
                      ->whereYear('tanggal', substr($request->bulan, 0, 4));
                });
            })
            ->get();

        $totalPenjualan = $details->sum('subtotal');

        $totalModal = $details->sum(function ($d) {
            return $d->barang->harga_modal * $d->qty;
        });

        $laba = $totalPenjualan - $totalModal;

        return view('owner.laporan.keuntungan', compact(
            'totalPenjualan',
            'totalModal',
            'laba'
        ));
    }

    /**
     * ===============================
     * 4️⃣ LAPORAN PER PRODUK (TERLARIS)
     * ===============================
     */
    public function produk(Request $request)
    {
        $produk = PenjualanDetail::select(
                'barang_id',
                DB::raw('SUM(qty) as total_terjual'),
                DB::raw('SUM(subtotal) as omzet')
            )
            ->whereHas('penjualan', function ($q) {
                $q->where('status', 'selesai');
            })
            ->groupBy('barang_id')
            ->with('barang')
            ->orderByDesc('total_terjual')
            ->get();

        return view('owner.laporan.produk', compact('produk'));
    }

    // EXPORT PENJUALAN
public function exportPenjualanExcel(Request $request)
{
    $data = Penjualan::where('status','selesai')->get();
    return Excel::download(
        new LaporanPenjualanExport($data),
        'laporan-penjualan.xlsx'
    );
}

public function exportPenjualanPdf()
{
    $penjualans = Penjualan::where('status','selesai')->get();
    $pdf = PDF::loadView('owner.laporan.pdf.penjualan', compact('penjualans'));
    return $pdf->download('laporan-penjualan.pdf');
}



public function exportPembelianPdf(Request $request)
{
    $stokMasuk = StokMasuk::with('barang')
        ->orderByDesc('tanggal_masuk')
        ->get();

    $totalPembelian = $stokMasuk->sum(function ($s) {
        return $s->jumlah * ($s->barang->harga_modal ?? 0);
    });

    $pdf = Pdf::loadView(
        'owner.laporan.pdf.pembelian',
        compact('stokMasuk', 'totalPembelian')
    )->setPaper('A4', 'portrait');

    return $pdf->stream('laporan-pembelian.pdf');
}
public function exportProdukPdf()
    {
        $produk = Barang::withCount('penjualanDetails')
            ->orderByDesc('penjualan_details_count')
            ->get();

        $pdf = Pdf::loadView('owner.laporan.pdf.produk', compact('produk'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download('laporan-produk-terlaris.pdf');
    }

}
