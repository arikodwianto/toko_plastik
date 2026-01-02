@extends('layouts.owner-app')

@section('content')
<main class="app-main">
    <h3>Edit Barang</h3>

    <form action="{{ route('owner.stok.update', $barang->id) }}" method="POST">
        @csrf @method('PUT')

        <label>Kode Barang</label>
        <input type="text" name="kode_barang" class="form-control" value="{{ $barang->kode_barang }}" required>

        <label class="mt-2">Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>

        <label class="mt-2">Harga Modal</label>
        <input type="number" name="harga_modal" class="form-control" value="{{ $barang->harga_modal }}" required>

        <label class="mt-2">Harga Jual</label>
        <input type="number" name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" required>

        <label class="mt-2">Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ $barang->stok }}" required>

        <button class="btn btn-primary mt-3">Update</button>
    </form>
</main>
@endsection
