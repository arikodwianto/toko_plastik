@extends('layouts.owner-app')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Laporan Pembelian Supplier</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('owner.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Laporan Pembelian</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <!-- Filter -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal"
                                   value="{{ request('tanggal') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">
                                <i class="bi bi-funnel-fill me-1"></i> Terapkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body text-center">
                            <i class="bi bi-cart-plus fs-2 text-success"></i>
                            <h6 class="mt-2">Total Pembelian</h6>
                            <h4>
                                Rp {{ number_format($totalPembelian,0,',','.') }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi (DI LUAR CARD) -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('owner.laporan.pembelian.pdf') }}"
                   class="btn btn-danger btn-sm"
                   target="_blank">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Cetak PDF
                </a>
            </div>

            <!-- Tabel -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-truck me-2"></i> Data Pembelian Supplier
                    </h4>
                </div>

                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle" id="dataTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Barang</th>
                                    <th>Supplier</th>
                                    <th class="text-center">Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stokMasuk as $s)
                                    <tr>
                                        <td>{{ $s->tanggal_masuk }}</td>
                                        <td><strong>{{ $s->barang->nama }}</strong></td>
                                        <td>{{ $s->supplier ?? '-' }}</td>
                                        <td class="text-center">{{ $s->jumlah }}</td>
                                        <td>
                                            Rp {{ number_format($s->jumlah * $s->barang->harga_modal,0,',','.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Data pembelian tidak ditemukan
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
