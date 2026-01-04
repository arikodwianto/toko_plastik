@extends('layouts.owner-app')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Manajemen Stok Barang</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('owner.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Stok Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>  

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            {{-- Alert Success --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Tombol Tambah Barang -->
            <div class="mb-3">
                <a href="{{ route('owner.stok.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Barang
                </a>
            </div>

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
    <i class="bi bi-box-seam me-2"></i> Data Stok Barang

    @php
        $stokMenipis = $barangs->where('stok', '<', 5)->count();
    @endphp

    @if ($stokMenipis > 0)
        <span class="badge bg-danger ms-2">
            {{ $stokMenipis }} Menipis
        </span>
    @endif
</h4>

                </div>

                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle" id="dataTable">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center" width="50">No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga Modal</th>
                                    <th>Harga Jual</th>
                                    <th class="text-center">Stok</th>
                                    <th>Margin</th>
                                    <th class="text-center" width="300">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($barangs as $i)
                                    <tr class="{{ $i->stok_menipis ? 'table-danger' : '' }}">

                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td><strong>{{ $i->kode_barang }}</strong></td>
                                        <td>{{ $i->nama }}</td>
                                        <td>Rp {{ number_format($i->harga_modal, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($i->harga_jual, 0, ',', '.') }}</td>
                                        <td class="text-center">
    {{ $i->stok }}

    @if ($i->stok_menipis)
        <span class="badge bg-danger d-block mt-1">
            Stok Menipis
        </span>
    @endif
</td>

                                        <td>
                                            Rp {{ number_format($i->margin, 0, ',', '.') }}
                                            <br>
                                            <small class="text-muted">{{ $i->margin_persen }}%</small>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('owner.stok.edit', $i->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <a href="{{ route('owner.stok.mutasi', $i->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-arrow-left-right"></i>
                                            </a>

                                            <button class="btn btn-sm btn-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#stokMasuk{{ $i->id }}">
                                                <i class="bi bi-box-arrow-in-down"></i>
                                            </button>

                                            <button class="btn btn-sm btn-secondary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#opname{{ $i->id }}">
                                                <i class="bi bi-clipboard-check"></i>
                                            </button>

                                            <form action="{{ route('owner.stok.destroy', $i->id) }}"
                                                  method="POST"
                                                  class="d-inline form-hapus">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Stok Masuk -->
                                    <div class="modal fade" id="stokMasuk{{ $i->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('owner.stok.masuk') }}">

                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Stok Masuk: {{ $i->nama }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                                    <div class="modal fade" id="opname{{ $i->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('owner.stok.opname') }}">

                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Stok Opname: {{ $i->nama }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Data barang belum ada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>
@endsection
