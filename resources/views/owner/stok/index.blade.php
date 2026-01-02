@extends('layouts.owner-app')

@section('content')
<main class="app-main">
    <div class="app-content-header mb-3">
        <h3>Manajemen Stok Barang</h3>
    </div>

    <a href="{{ route('owner.stok.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus"></i> Tambah Barang
    </a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Modal</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($barangs as $i)
            <tr>
                <td>{{ $i->kode_barang }}</td>
                <td>{{ $i->nama }}</td>
                <td>Rp {{ number_format($i->harga_modal) }}</td>
                <td>Rp {{ number_format($i->harga_jual) }}</td>
                <td>{{ $i->stok }}</td>
                <td>
                    <a href="{{ route('owner.stok.edit', $i->id) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="{{ route('owner.stok.mutasi', $i->id) }}" class="btn btn-info btn-sm">
                        Mutasi
                    </a>

                    <!-- STOK MASUK -->
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#stokMasuk{{ $i->id }}">
                        Stok Masuk
                    </button>

                    <!-- OPNAME -->
                    <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#opname{{ $i->id }}">
                        Opname
                    </button>

                    <form action="{{ route('owner.stok.destroy', $i->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus barang?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Modal Stok Masuk -->
            <div class="modal fade" id="stokMasuk{{ $i->id }}">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('owner.stok.stokMasuk.store') }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Stok Masuk: {{ $i->nama_barang }}</h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="barang_id" value="{{ $i->id }}">

                                <label>Jumlah Masuk</label>
                                <input type="number" name="jumlah" class="form-control" required>

                                <label class="mt-2">Supplier</label>
                                <input type="text" name="supplier" class="form-control">
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Stok Opname -->
            <div class="modal fade" id="opname{{ $i->id }}">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('owner.stok.opname.store') }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Stok Opname: {{ $i->nama_barang }}</h5>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="barang_id" value="{{ $i->id }}">

                                <label>Stok Fisik</label>
                                <input type="number" name="stok_fisik" class="form-control" required>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</main>
@endsection