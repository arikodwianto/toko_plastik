<?php

namespace App\Http\Controllers\AdminKasir;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\MutasiStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Halaman kasir (POS)
     */
    public function index()
    {
        return view('admin_kasir.penjualan.index');
    }

    /**
     * Cari barang (barcode / nama)
     * AJAX
     */
    public function cariBarang(Request $request)
    {
        $q = $request->q;

        $barang = Barang::where('kode_barang', $q)
            ->orWhere('nama', 'like', "%{$q}%")
            ->where('stok', '>', 0)
            ->first();

        return response()->json($barang);
    }

    /**
     * Simpan transaksi penjualan
     */
   public function store(Request $request)
{
    $request->validate([
        'items' => 'required|array|min:1',
        'items.*.barang_id' => 'required|exists:barang,id',
        'items.*.qty' => 'required|integer|min:1',
        'items.*.diskon' => 'nullable|numeric|min:0',
        'diskon_total' => 'nullable|numeric|min:0',
        'total_bayar' => 'required|numeric|min:0',
        'metode_pembayaran' => 'required|in:cash,transfer,qris',
        'bayar' => 'required|numeric|min:0',
    ]);

    DB::beginTransaction();

    try {

        /**
         * 1️⃣ VALIDASI STOK (ANTI MINUS)
         */
        foreach ($request->items as $item) {
            $barang = Barang::lockForUpdate()->findOrFail($item['barang_id']);

            if ($barang->stok < $item['qty']) {
                throw new \Exception(
                    'Stok ' . $barang->nama . ' tidak mencukupi'
                );
            }
        }

        /**
         * 2️⃣ SIMPAN PENJUALAN
         */
        $penjualan = Penjualan::create([
            'kode_transaksi' => 'TRX-' . now()->format('YmdHis'),
            'total' => $request->total_bayar,
            'diskon_total' => $request->diskon_total ?? 0,
            'bayar' => $request->bayar,
            'kembalian' => $request->bayar - $request->total_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'kasir_id' => auth()->id(),
            'tanggal' => now(),
        ]);

        /**
         * 3️⃣ DETAIL + KURANGI STOK
         */
        foreach ($request->items as $item) {
            $barang = Barang::lockForUpdate()->findOrFail($item['barang_id']);

            // Kurangi stok (AMAN)
            $barang->decrement('stok', $item['qty']);

            PenjualanDetail::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $barang->id,
                'harga' => $barang->harga_jual,
                'qty' => $item['qty'],
                'diskon' => $item['diskon'] ?? 0,
                'subtotal' =>
                    ($barang->harga_jual * $item['qty'])
                    - ($item['diskon'] ?? 0),
            ]);

            MutasiStok::create([
                'barang_id' => $barang->id,
                'jumlah' => $item['qty'],
                'tipe' => 'keluar',
                'keterangan' => 'Penjualan',
            ]);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'id' => $penjualan->id,
            'message' => 'Transaksi berhasil disimpan'
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 400);
    }
}


    /**
     * Cetak struk
     */
    public function struk($id)
    {
        $penjualan = Penjualan::with('details.barang')->findOrFail($id);
        return view('admin_kasir.penjualan.struk', compact('penjualan'));
    }
   public function riwayat(Request $request)
{
    $query = Penjualan::with('kasir')
        ->where('status', 'selesai');

    if ($request->filled('tanggal')) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    if ($request->filled('bulan')) {
        $query->whereMonth('tanggal', substr($request->bulan, 5, 2))
              ->whereYear('tanggal', substr($request->bulan, 0, 4));
    }

    $penjualans = $query->orderByDesc('tanggal')->get();

    $totalTransaksi = $penjualans->count();
    $totalPenjualan = $penjualans->sum('total');

    return view('admin_kasir.penjualan.riwayat', compact(
        'penjualans',
        'totalTransaksi',
        'totalPenjualan'
    ));
}


public function detail($id)
{
    $penjualan = Penjualan::with('details.barang', 'kasir')
        ->findOrFail($id);

    return view('admin_kasir.penjualan.detail', compact('penjualan'));
}
public function batal($id)
{
    DB::beginTransaction();

    try {
        $penjualan = Penjualan::with('details.barang')
            ->lockForUpdate()
            ->findOrFail($id);

        // ❌ Cegah batal dua kali
        if ($penjualan->status === 'dibatalkan') {
            throw new \Exception('Transaksi sudah dibatalkan');
        }

        // 🔁 Kembalikan stok
        foreach ($penjualan->details as $detail) {
            $detail->barang->increment('stok', $detail->qty);

            MutasiStok::create([
                'barang_id' => $detail->barang_id,
                'jumlah' => $detail->qty,
                'tipe' => 'retur',
                'keterangan' => 'Pembatalan transaksi ' . $penjualan->kode_transaksi,
            ]);
        }

        // 🔄 Update status transaksi
        $penjualan->update([
            'status' => 'dibatalkan'
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil dibatalkan'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 400);
    }
}
public function returItem(Request $request, $id)
{
    $request->validate([
        'items' => 'required|array|min:1',
        'items.*.detail_id' => 'required|exists:penjualan_details,id',
        'items.*.qty' => 'required|integer|min:1',
        'alasan' => 'nullable|string'
    ]);

    DB::beginTransaction();

    try {
        $penjualan = Penjualan::with('details.barang')
            ->lockForUpdate()
            ->findOrFail($id);

        if ($penjualan->status === 'dibatalkan') {
            throw new \Exception('Transaksi sudah dibatalkan');
        }

        $totalRetur = 0;

        foreach ($request->items as $item) {
            $detail = PenjualanDetail::lockForUpdate()
                ->findOrFail($item['detail_id']);

            $sisa = $detail->qty - $detail->qty_retur;

            if ($item['qty'] > $sisa) {
                throw new \Exception(
                    'Qty retur melebihi sisa pembelian'
                );
            }

            // update qty retur
            $detail->increment('qty_retur', $item['qty']);

            // hitung nilai retur
            $nilaiRetur =
                ($detail->harga * $item['qty']) - $detail->diskon;

            $totalRetur += $nilaiRetur;

            // stok balik
            $detail->barang->increment('stok', $item['qty']);

            // mutasi stok
            MutasiStok::create([
                'barang_id' => $detail->barang_id,
                'jumlah' => $item['qty'],
                'tipe' => 'retur',
                'keterangan' => 'Retur item ' . $penjualan->kode_transaksi,
            ]);
        }

        // koreksi total penjualan
        $penjualan->decrement('total', $totalRetur);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Retur berhasil diproses'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 400);
    }
}

}
