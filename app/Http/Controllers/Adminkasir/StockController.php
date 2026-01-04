<?php

namespace App\Http\Controllers\AdminKasir;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\MutasiStok;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Tampilkan daftar stok barang (READ ONLY)
     */
    public function index()
    {
        $barangs = Barang::orderBy('nama')->get();
        return view('admin_kasir.stok.index', compact('barangs'));
    }

    /**
     * Form tambah stok
     */
    public function create()
    {
        $barangs = Barang::orderBy('nama')->get();
        return view('admin_kasir.stok.create', compact('barangs'));
    }

    /**
     * Simpan stok masuk (KHUSUS ADMIN KASIR)
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah'    => 'required|integer|min:1',
            'supplier'  => 'nullable|string|max:255',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Tambah stok barang
        $barang->increment('stok', $request->jumlah);

        // Simpan ke tabel stok_masuk
        StokMasuk::create([
            'barang_id'     => $barang->id,
            'jumlah'        => $request->jumlah,
            'supplier'      => $request->supplier,
            'tanggal_masuk' => now(),
        ]);

        // Catat mutasi stok
        MutasiStok::create([
            'barang_id' => $barang->id,
            'jumlah'    => $request->jumlah,
            'tipe'      => 'masuk',
            'keterangan'=> 'Stok masuk oleh admin kasir',
        ]);

        return redirect()
            ->route('admin_kasir.stok.index')
            ->with('success', 'Stok berhasil ditambahkan');
    }
}

