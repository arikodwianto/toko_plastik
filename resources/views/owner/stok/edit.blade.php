@extends('layouts.owner-app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Barang</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('owner.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('owner.stok.index') }}">Stok Barang</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Periksa kembali data yang Anda input:
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i> Form Edit Barang
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('owner.stok.update', $barang->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Barang</label>
                                <input type="text"
                                       name="nama"
                                       class="form-control"
                                       value="{{ old('nama', $barang->nama) }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Stok</label>
                                <input type="number"
                                       name="stok"
                                       class="form-control"
                                       value="{{ old('stok', $barang->stok) }}"
                                       required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Harga Modal</label>
                                <input type="text"
                                       id="harga_modal"
                                       class="form-control rupiah"
                                       value="Rp {{ number_format(old('harga_modal', $barang->harga_modal), 0, ',', '.') }}">
                                <input type="hidden"
                                       name="harga_modal"
                                       id="harga_modal_value"
                                       value="{{ old('harga_modal', $barang->harga_modal) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Harga Jual</label>
                                <input type="text"
                                       id="harga_jual"
                                       class="form-control rupiah"
                                       value="Rp {{ number_format(old('harga_jual', $barang->harga_jual), 0, ',', '.') }}">
                                <input type="hidden"
                                       name="harga_jual"
                                       id="harga_jual_value"
                                       value="{{ old('harga_jual', $barang->harga_jual) }}">
                            </div>

                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('owner.stok.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i> Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
