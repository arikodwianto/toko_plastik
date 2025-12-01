@extends('layouts.owner-app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Daftar Pengguna</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('owner.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pengguna</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tombol Tambah Kelas di luar card -->
            <div class="mb-3">
                <a href="{{ route('owner.users.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Pengguna
                </a>
            </div>

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-building me-2"></i> Data Pengguna</h4>
                </div>
                <div class="card-body p-3">
                    @if ($users->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle" id="dataTable">
                                <thead class="table-primary">
                                    <tr>
                                         <th>Nama</th>
                                         <th>Email</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                                           <td class="text-center">
    <a href="{{ route('owner.users.edit', $u->id) }}" class="btn btn-sm btn-warning">
        <i class="bi bi-pencil-square"></i>
    </a>

    <form action="{{ route('owner.users.destroy', $u->id) }}" method="POST" class="d-inline form-hapus">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger mb-1">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center mb-0">Belum ada data pengguna.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
