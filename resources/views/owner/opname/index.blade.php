@extends('layouts.owner-app')

@section('content')
<main class="app-main">
    <h3>Stok Opname</h3>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Barang</th>
                <th>Stok Sistem</th>
                <th>Stok Fisik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $b)
                <tr>
                    <form action="{{ route('owner.opname.store') }}" method="POST">
                        @csrf
                        <td>{{ $b->nama }}</td>
                        <td>{{ $b->stok }}</td>
                        <td>
                            <input type="number"
                                   name="stok_fisik"
                                   class="form-control"
                                   required>
                            <input type="hidden" name="barang_id" value="{{ $b->id }}">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                Simpan
                            </button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection
