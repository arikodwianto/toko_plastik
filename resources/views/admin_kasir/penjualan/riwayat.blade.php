@extends('layouts.kasir-app')

@section('content')
<main class="app-main">

    {{-- Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Riwayat Penjualan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('kasir.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Riwayat Penjualan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="app-content">
        <div class="container-fluid">

            {{-- Filter --}}
            <form class="row g-3 mb-3">
                <div class="col-md-3">
                    <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                </div>
                <div class="col-md-3">
                    <input type="month" name="bulan" class="form-control" value="{{ request('bulan') }}">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                </div>
            </form>

            {{-- SUMMARY (TETAP ADA) --}}
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="card shadow-lg border-0 text-center">
                        <div class="card-body">
                            <i class="bi bi-receipt fs-4 text-primary"></i>
                            <h6 class="text-muted mt-2">Total Transaksi</h6>
                            <h4 class="fw-bold">{{ $totalTransaksi }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow-lg border-0 text-center">
                        <div class="card-body">
                            <i class="bi bi-cash-stack fs-4 text-success"></i>
                            <h6 class="text-muted mt-2">Total Penjualan</h6>
                            <h4 class="fw-bold">
                                Rp {{ number_format($totalPenjualan) }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-receipt me-2"></i> Data Penjualan
                        <span class="badge bg-light text-primary ms-2">
                            {{ $totalTransaksi }} Transaksi
                        </span>
                    </h4>
                </div>

                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle mb-0" id="dataTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>Kode</th>
                                    <th>Tanggal</th>
                                    <th>Kasir</th>
                                    <th>Total</th>
                                    <th>Metode</th>
                                    <th class="text-center" width="220">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penjualans as $p)
                                    <tr>
                                        <td><strong>{{ $p->kode_transaksi }}</strong></td>
                                        <td>{{ $p->tanggal }}</td>
                                        <td>{{ $p->kasir->name ?? '-' }}</td>
                                        <td>Rp {{ number_format($p->total) }}</td>
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ strtoupper($p->metode_pembayaran) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin_kasir.penjualan.detail', $p->id) }}"
                                               class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('admin_kasir.penjualan.struk', $p->id) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-secondary">
                                                <i class="bi bi-printer"></i>
                                            </a>

                                            @if ($p->status === 'selesai')
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="batalTransaksi({{ $p->id }})">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Data penjualan belum tersedia
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

@push('scripts')
<script>
function batalTransaksi(id) {
    if (!confirm('Yakin batalkan transaksi ini?')) return;

    fetch(`/admin_kasir/penjualan/${id}/batal`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.success) location.reload();
    });
}
</script>
@endpush
