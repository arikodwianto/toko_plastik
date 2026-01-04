@extends('layouts.owner-app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Mutasi Stok</h3>
                    <small class="text-muted">
                        Barang: <strong>{{ $barang->nama }}</strong>
                    </small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('owner.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('owner.stok.index') }}">Stok Barang</a>
                        </li>
                        <li class="breadcrumb-item active">Mutasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-arrow-left-right me-2"></i> Riwayat Mutasi Stok
                    </h4>
                </div>

                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>Tipe</th>
                                    <th class="text-center">Jumlah</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mutasi as $m)
                                    <tr>
                                        <td>
                                            @if ($m->tipe === 'masuk')
                                                <span class="badge bg-success">
                                                    <i class="bi bi-box-arrow-in-down"></i> Masuk
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-box-arrow-up"></i> Keluar
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ number_format($m->jumlah, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $m->keterangan }}</td>
                                        <td class="text-center">
                                            {{ $m->created_at->format('d-m-Y H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Belum ada mutasi stok.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('owner.stok.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>
@endsection
