<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Item;
use App\Models\StokMasuk;
use App\Models\MutasiStok;
use App\Models\StokOpname;


class UserManagementController extends Controller
{
    /**
     * LIST USER (owner lihat semua admin_kasir)
     */
    public function index()
    {
        $users = User::where('role', 'admin_kasir')->get();

        return view('owner.users.index', compact('users'));
    }

    /**
     * FORM TAMBAH USER
     */
    public function create()
    {
        return view('owner.users.create');
    }

    /**
     * SIMPAN USER BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin_kasir',
        ]);

        return redirect()->route('owner.users.index')
            ->with('success', 'User admin kasir berhasil dibuat.');
    }

    /**
     * FORM EDIT USER
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('owner.users.edit', compact('user'));
    }

    /**
     * UPDATE USER
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6', // opsional
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('owner.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * HAPUS USER
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}


class StockManagementController extends Controller
{
    /**
     * Hanya OWNER yang boleh akses (pastikan middleware nya)
     */
    public function __construct()
    {
        $this->middleware('owner');
    }

    /**
     * LIST SEMUA STOK BARANG
     */
    public function index()
    {
        $items = Item::orderBy('nama_barang')->get();
        return view('owner.stok.index', compact('items'));
    }

    /**
     * FORM TAMBAH BARANG
     */
    public function create()
    {
        return view('owner.stok.create');
    }

    /**
     * SIMPAN BARANG BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang',
            'nama_barang' => 'required',
            'harga_modal' => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'stok'        => 'required|numeric',
        ]);

        Item::create($request->all());

        return redirect()->route('owner.stok.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * FORM EDIT BARANG
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('owner.stok.edit', compact('item'));
    }

    /**
     * UPDATE BARANG
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang,' . $item->id,
            'nama_barang' => 'required',
            'harga_modal' => 'required|numeric',
            'harga_jual'  => 'required|numeric',
            'stok'        => 'required|numeric',
        ]);

        $item->update($request->all());

        return redirect()->route('owner.stok.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * HAPUS BARANG
     */
    public function destroy($id)
    {
        Item::findOrFail($id)->delete();

        return back()->with('success', 'Barang berhasil dihapus.');
    }

    /**
     * INPUT STOK MASUK DARI SUPPLIER
     */
    public function stokMasukStore(Request $request)
    {
        $request->validate([
            'item_id'  => 'required',
            'jumlah'   => 'required|numeric',
            'supplier' => 'nullable|string'
        ]);

        // tambah stok
        $item = Item::findOrFail($request->item_id);
        $item->stok += $request->jumlah;
        $item->save();

        // simpan riwayat stok masuk
        StokMasuk::create([
            'item_id'  => $request->item_id,
            'jumlah'   => $request->jumlah,
            'supplier' => $request->supplier,
            'tanggal_masuk' => now(),
        ]);

        // catat mutasi
        MutasiStok::create([
            'item_id' => $request->item_id,
            'jumlah'  => $request->jumlah,
            'tipe'    => 'masuk',
            'keterangan' => 'Stok masuk dari supplier',
        ]);

        return back()->with('success', 'Stok masuk berhasil ditambahkan.');
    }

    /**
     * LIHAT MUTASI STOK
     */
    public function mutasi($id)
    {
        $item = Item::findOrFail($id);
        $mutasi = MutasiStok::where('item_id', $id)->orderBy('id','DESC')->get();

        return view('owner.stok.mutasi', compact('item', 'mutasi'));
    }

    /**
     * STOK OPNAME
     */
    public function opnameStore(Request $request)
    {
        $request->validate([
            'item_id'      => 'required',
            'stok_fisik'   => 'required|numeric',
        ]);

        $item = Item::findOrFail($request->item_id);
        $selisih = $request->stok_fisik - $item->stok;

        // catat opname
        StokOpname::create([
            'item_id'      => $item->id,
            'stok_sistem'  => $item->stok,
            'stok_fisik'   => $request->stok_fisik,
            'selisih'      => $selisih,
            'tanggal_opname' => now(),
        ]);

        // update stok sesuai fisik
        $item->stok = $request->stok_fisik;
        $item->save();

        // mutasi
        MutasiStok::create([
            'item_id' => $item->id,
            'jumlah'  => $selisih,
            'tipe'    => $selisih >= 0 ? 'masuk' : 'keluar',
            'keterangan' => 'Stok Opname',
        ]);

        return back()->with('success', 'Stok opname berhasil disimpan.');
    }
}