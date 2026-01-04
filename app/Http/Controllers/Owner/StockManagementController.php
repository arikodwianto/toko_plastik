<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\MutasiStok;
use App\Models\StokOpname;
use Illuminate\Http\Request;

class StockManagementController extends Controller
{
    /**
  /**
 * List semua barang
 */
public function index()
{
    $barangs = Barang::all();
    return view('owner.stok.index', compact('barangs'));
}

/**
 * Form tambah barang
 */
public function create()
{
    return view('owner.stok.create');
}

/**
 * Simpan barang baru
 */
public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'stok' => 'required|integer',
        'harga_modal' => 'required|numeric',
        'harga_jual' => 'required|numeric',
    ]);

    Barang::create([
        'nama' => $request->nama,
        'stok' => $request->stok,
        'harga_modal' => $request->harga_modal,
        'harga_jual' => $request->harga_jual,
        // kode_barang otomatis dari Model
    ]);

    return redirect()
        ->route('owner.stok.index')
        ->with('success', 'Barang berhasil disimpan');
}

/**
 * Form edit barang
 */
public function edit($id)
{
    $barang = Barang::findOrFail($id);
    return view('owner.stok.edit', compact('barang'));
}

/**
 * Update barang
 */
public function update(Request $request, $id)
{
    $request->validate([
    'nama' => 'required|string|max:255',
    'stok' => 'required|integer',
    'harga_modal' => 'required|numeric|min:0',
    'harga_jual' => 'required|numeric|gte:harga_modal',
]);

    $barang = Barang::findOrFail($id);
    $barang->update($request->only([
        'nama',
        'stok',
        'harga_modal',
        'harga_jual'
    ]));

    return redirect()
        ->route('owner.stok.index')
        ->with('success', 'Barang berhasil diperbarui');
}

/**
 * Hapus barang
 */
public function destroy($id)
{
    Barang::findOrFail($id)->delete();

    return redirect()
        ->route('owner.stok.index')
        ->with('success', 'Barang berhasil dihapus');
}



    /**
     * List stok masuk
     */
    public function stokMasukIndex()
    {
        $stokMasuk = StokMasuk::with('barang')->latest()->get();
        return view('owner.stok_masuk.index', compact('stokMasuk'));
    }

    /**
     * Form input stok masuk
     */
    public function stokMasukCreate()
    {
        $barang = barang::all();
        return view('owner.stok_masuk.create', compact('barang'));
    }

    /**
     * Simpan stok masuk
     */
   public function stokMasukStore(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:barang,id',
        'jumlah' => 'required|integer|min:1',
        'supplier' => 'nullable|string|max:255',
    ]);

    $barang = Barang::findOrFail($request->barang_id);

    // tambah stok (AMAN)
    $barang->increment('stok', $request->jumlah);

    // simpan stok masuk
 StokMasuk::create([
    'barang_id' => $barang->id,
    'jumlah' => $request->jumlah,
    'supplier' => $request->supplier,
    'tanggal_masuk' => now(),
]);


    // simpan mutasi stok
    MutasiStok::create([
        'barang_id' => $barang->id,
        'jumlah' => $request->jumlah,
        'tipe' => 'masuk',
        'keterangan' => 'Stok masuk dari supplier',
    ]);

    return redirect()
        ->route('owner.stok.index')
        ->with('success', 'Stok berhasil ditambahkan');
}


public function mutasi($id)
{
    $barang = Barang::findOrFail($id);
    $mutasi = MutasiStok::where('barang_id', $id)
                ->orderByDesc('id')
                ->get();

    return view('owner.stok.mutasi', compact('barang', 'mutasi'));
}


    /**
     * Mutasi stok
     */
    public function mutasiIndex()
    {
        $mutasi = MutasiStok::with('barang')->latest()->get();
        return view('owner.mutasi.index', compact('mutasi'));
    }

    /**
     * Halaman stok opname
     */
    public function opnameIndex()
    {
        $barang = Barang::all();
        return view('owner.opname.index', compact('barang'));
    }

    /**
     * Proses stok opname
     */
    public function opnameStore(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:barang,id',
        'stok_fisik' => 'required|integer|min:0',
    ]);

    $barang = Barang::findOrFail($request->barang_id);

    $selisih = $request->stok_fisik - $barang->stok;

    // update stok barang
    $barang->update([
        'stok' => $request->stok_fisik,
    ]);

    // simpan mutasi stok
    MutasiStok::create([
        'barang_id' => $barang->id,
        'jumlah' => abs($selisih),
        'tipe' => $selisih >= 0 ? 'opname_plus' : 'opname_minus',
        'keterangan' => 'Stok opname',
    ]);

    return back()->with('success', 'Stok opname berhasil disimpan');
}

}
