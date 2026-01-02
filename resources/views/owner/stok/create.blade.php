@extends('layouts.owner-app')

@section('content')
<main class="app-main">
    <h3>Tambah Barang</h3>

    <form action="{{ route('owner.stok.store') }}" method="POST">
        @csrf

        <label>Kode Barang</label>
        <input type="text" name="kode_barang" class="form-control" required>

        <label class="mt-2">Nama Barang</label>
        <input type="text" name="nama" class="form-control" required>

        <label class="mt-2">Harga Modal</label>
        <input type="number" name="harga_modal" class="form-control" required>

        <label class="mt-2">Harga Jual</label>
        <input type="number" name="harga_jual" class="form-control" required>

        <label class="mt-2">Stok Awal</label>
        <input type="number" name="stok" class="form-control" required>

        <button class="btn btn-primary mt-3">Simpan</button>
    </form>
</main>
@endsection
