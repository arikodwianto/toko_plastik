@extends('layouts.kasir-app')

@section('content')
<main class="app-main">

    {{-- Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tambah Stok Barang</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('kasir.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin_kasir.stok.index') }}">Stok Barang</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Stok</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="app-content">
        <div class="container-fluid">

            {{-- Card Form --}}
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-box-arrow-in-down me-2"></i>
                        Form Tambah Stok
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin_kasir.stok.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Barang</label>
                                <select name="barang_id" class="form-select" required>
                                    <option value="">-- Pilih Barang --</option>
                                    @foreach ($barangs as $b)
                                        <option value="{{ $b->id }}">
                                            {{ $b->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jumlah</label>
                                <input
                                    type="number"
                                    name="jumlah"
                                    class="form-control"
                                    min="1"
                                    required
                                >
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Supplier (Opsional)</label>
                                <input
                                    type="text"
                                    name="supplier"
                                    class="form-control"
                                    placeholder="Nama supplier"
                                >
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('admin_kasir.stok.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i>
                                Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</main>
@endsection
