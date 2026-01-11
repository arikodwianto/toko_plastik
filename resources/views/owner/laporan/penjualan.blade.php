@extends('layouts.owner-app')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Laporan Penjualan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('owner.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Laporan Penjualan</li>
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
                        <div class="col-md-3">
                            <label class="form-label">Filter</label>
                            <select name="filter" class="form-select">
                                <option value="">-- Pilih Filter --</option>
                                <option value="harian" {{ request('filter')=='harian' ? 'selected' : '' }}>Harian</option>
                                <option value="mingguan" {{ request('filter')=='mingguan' ? 'selected' : '' }}>Mingguan</option>
                                <option value="bulanan" {{ request('filter')=='bulanan' ? 'selected' : '' }}>Bulanan</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control"
                                   value="{{ request('tanggal') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Bulan</label>
                            <input type="month" name="bulan" class="form-control"
                                   value="{{ request('bulan') }}">
                        </div>

                        <div class="col-md-3">
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
                            <i class="bi bi-receipt fs-2 text-primary"></i>
                            <h6 class="mt-2">Total Transaksi</h6>
                            <h4>{{ $totalTransaksi }}</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body text-center">
                            <i class="bi bi-cash-stack fs-2 text-success"></i>
                            <h6 class="mt-2">Total Penjualan</h6>
                            <h4>
                                Rp {{ number_format($totalPenjualan,0,',','.') }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tombol Aksi -->
<div class="d-flex justify-content-end mb-3 gap-2">
    
    <a href="{{ route('owner.laporan.penjualan.excel') }}"
       class="btn btn-success btn-sm">
        <i class="bi bi-file-earmark-excel me-1"></i> Excel
    </a>

    <a href="{{ route('owner.laporan.penjualan.pdf') }}"
       class="btn btn-danger btn-sm">
        <i class="bi bi-file-earmark-pdf me-1"></i> PDF
    </a>
</div>


            <!-- Tabel -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-bar-chart-fill me-2"></i> Data Penjualan
                    </h4>

                   
                </div>

                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle" id="dataTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Kasir</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penjualans as $p)
                                    <tr>
                                        <td>{{ $p->tanggal }}</td>
                                        <td><strong>{{ $p->kode_transaksi }}</strong></td>
                                        <td>{{ $p->kasir->name ?? '-' }}</td>
                                        <td>
                                            Rp {{ number_format($p->total,0,',','.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Data penjualan tidak ditemukan
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
