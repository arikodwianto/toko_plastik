@extends('layouts.kasir-app')

@section('content')
<main class="app-main">

    {{-- Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Detail Penjualan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('kasir.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin_kasir.penjualan.riwayat') }}">Riwayat Penjualan</a>
                        </li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="app-content">
        <div class="container-fluid">

            {{-- INFO TRANSAKSI --}}
            <div class="card shadow-lg border-0 rounded-3 mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i> Informasi Transaksi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <strong>Kode:</strong><br>
                            {{ $penjualan->kode_transaksi }}
                        </div>
                        <div class="col-md-4 mb-2">
                            <strong>Tanggal:</strong><br>
                            {{ $penjualan->tanggal }}
                        </div>
                        <div class="col-md-4 mb-2">
                            <strong>Kasir:</strong><br>
                            {{ $penjualan->kasir->name ?? '-' }}
                        </div>
                        <div class="col-md-4 mb-2">
                            <strong>Metode:</strong><br>
                            {{ strtoupper($penjualan->metode_pembayaran) }}
                        </div>
                        <div class="col-md-4 mb-2">
                            <strong>Status:</strong><br>
                            @if ($penjualan->status === 'dibatalkan')
                                <span class="badge bg-danger">DIBATALKAN</span>
                            @else
                                <span class="badge bg-success">SELESAI</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM RETUR --}}
            @if ($penjualan->status === 'selesai')
            <form id="returForm">
            @endif

            {{-- TABLE --}}
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-box-seam me-2"></i> Detail Barang
                    </h5>
                </div>

                <div class="card-body p-3 table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>Barang</th>
                                <th class="text-end">Harga</th>
                                <th class="text-center">Qty Beli</th>
                                <th class="text-center">Sudah Retur</th>
                                <th class="text-center">Sisa</th>
                                <th class="text-center">Qty Retur</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penjualan->details as $i => $d)
                                @php
                                    $sisa = $d->qty - $d->qty_retur;
                                @endphp
                                <tr>
                                    <td>{{ $d->barang->nama }}</td>
                                    <td class="text-end">Rp {{ number_format($d->harga) }}</td>
                                    <td class="text-center">{{ $d->qty }}</td>
                                    <td class="text-center">{{ $d->qty_retur }}</td>
                                    <td class="text-center">{{ $sisa }}</td>
                                    <td class="text-center">
                                        @if ($penjualan->status === 'selesai' && $sisa > 0)
                                            <input type="number"
                                                name="items[{{ $i }}][qty]"
                                                class="form-control form-control-sm text-center"
                                                min="1"
                                                max="{{ $sisa }}"
                                                style="width:80px;margin:auto">

                                            <input type="hidden"
                                                name="items[{{ $i }}][detail_id]"
                                                value="{{ $d->id }}">
                                        @else
                                            <span class="badge bg-secondary">-</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        Rp {{ number_format($d->subtotal) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($penjualan->status === 'selesai')
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin_kasir.penjualan.riwayat') }}"
                       class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-arrow-repeat"></i> Proses Retur
                    </button>
                </div>
                @endif
            </div>

            @if ($penjualan->status === 'selesai')
            </form>
            @endif

        </div>
    </div>

</main>
@endsection


@push('scripts')
@if ($penjualan->status === 'selesai')
<script>
document.getElementById('returForm')
    ?.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!confirm('Yakin proses retur item yang dipilih?')) return;

        fetch("{{ route('admin_kasir.penjualan.retur', $penjualan->id) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: new FormData(this)
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if (data.success) location.reload();
        })
        .catch(() => {
            alert('Gagal memproses retur');
        });
    });
</script>
@endif
@endpush
