@extends('layouts.owner-app')

@section('content')

<main class="app-main">
    <div class="app-content-header mb-3">
        <h3>Stok Opname Barang</h3>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama Barang</th>
                <th>Stok Sistem</th>
                <th>Stok Fisik</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($barang as $b)
            <tr>
                <td>{{ $b->nama }}</td>
                <td>{{ $b->stok }}</td>
                <td>
                    <form action="{{ route('owner.opname.store') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="hidden" name="barang_id" value="{{ $b->id }}">
                        <input type="number" name="stok_fisik" class="form-control" required>
                </td>
                <td>
                        <button class="btn btn-secondary btn-sm">Simpan</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada barang</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</main>
@endsection
