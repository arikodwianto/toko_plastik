@extends('layouts.kasir-app')

@section('content')
<main class="app-main">

    {{-- Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Stok Barang</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('kasir.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Stok Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="app-content">
        <div class="container-fluid">

            {{-- Tombol Tambah Stok --}}
            <div class="mb-3">
                <a href="{{ route('admin_kasir.stok.create') }}" class="btn btn-success">
                    <i class="bi bi-box-arrow-in-down me-1"></i> Tambah Stok
                </a>
            </div>

            {{-- Card Data Stok --}}
            <div class="card shadow-sm border-0 rounded-3">

                {{-- Card Header --}}
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-box-seam me-2"></i> Data Stok
                    </h4>

                    @php
                        $stokMenipis = $barangs->where('stok', '<', 5)->count();
                    @endphp

                    @if ($stokMenipis > 0)
                        <span class="badge bg-danger">
                            {{ $stokMenipis }} Stok Menipis
                        </span>
                    @endif
                </div>

                {{-- Card Body --}}
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center" width="50">No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barangs as $i)
                                    <tr class="{{ $i->stok_menipis ? 'table-danger' : '' }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td><strong>{{ $i->kode_barang }}</strong></td>
                                        <td>{{ $i->nama }}</td>
                                        <td class="text-center">
                                            {{ $i->stok }}

                                            @if ($i->stok_menipis)
                                                <span class="badge bg-danger d-block mt-1">
                                                    Stok Menipis
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            Data stok belum tersedia
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            {{-- End Card --}}

        </div>
    </div>

</main>
@endsection
