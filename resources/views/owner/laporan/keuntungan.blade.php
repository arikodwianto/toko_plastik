@extends('layouts.owner-app')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Laporan Keuntungan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('owner.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Laporan Keuntungan</li>
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
                            <label class="form-label">Bulan</label>
                            <input type="month"
                                   name="bulan"
                                   value="{{ request('bulan') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">
                                <i class="bi bi-funnel-fill me-1"></i> Tampilkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ringkasan -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body text-center">
                            <i class="bi bi-cash fs-2 text-primary"></i>
                            <h6 class="mt-2">Total Penjualan</h6>
                            <h5>
                                Rp {{ number_format($totalPenjualan,0,',','.') }}
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body text-center">
                            <i class="bi bi-box fs-2 text-warning"></i>
                            <h6 class="mt-2">Total Modal</h6>
                            <h5>
                                Rp {{ number_format($totalModal,0,',','.') }}
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body text-center">
                            <i class="bi bi-graph-up-arrow fs-2 text-success"></i>
                            <h6 class="mt-2">Laba Bersih</h6>
                            <h5>
                                Rp {{ number_format($laba,0,',','.') }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-calculator me-2"></i> Ringkasan Keuntungan
                    </h4>
                </div>

                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle" id="dataTable">
                            <thead class="table-primary">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Total Penjualan</td>
                                    <td class="text-end">
                                        Rp {{ number_format($totalPenjualan,0,',','.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Total Modal</td>
                                    <td class="text-end">
                                        Rp {{ number_format($totalModal,0,',','.') }}
                                    </td>
                                </tr>
                                <tr class="table-success fw-bold">
                                    <td class="text-center">3</td>
                                    <td>Laba Bersih</td>
                                    <td class="text-end">
                                        Rp {{ number_format($laba,0,',','.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>
@endsection
