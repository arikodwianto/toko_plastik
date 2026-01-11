@extends('layouts.owner-app')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Laporan Produk Terlaris</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('owner.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Produk Terlaris</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <!-- Tombol Aksi (DI LUAR CARD) -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('owner.laporan.produk.pdf') }}"
                   class="btn btn-danger btn-sm"
                   target="_blank">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Cetak PDF
                </a>
            </div>

            <!-- Tabel -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-trophy-fill me-2"></i> Produk Terlaris
                    </h4>
                </div>

                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle" id="dataTable">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center">Rank</th>
                                    <th>Produk</th>
                                    <th class="text-center">Total Terjual</th>
                                    <th>Omzet</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produk as $i => $p)
                                    <tr>
                                        <td class="text-center fw-bold">
                                            {{ $i+1 }}
                                        </td>
                                        <td>
                                            <strong>{{ $p->barang->nama }}</strong>
                                        </td>
                                        <td class="text-center">
                                            {{ $p->total_terjual }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($p->omzet,0,',','.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Data produk terlaris tidak ditemukan
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
