@extends('layouts.owner-app')

@section('content')
<main class="app-main">
    <h3>Mutasi Stok: {{ $item->nama_barang }}</h3>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($mutasi as $m)
            <tr>
                <td>{{ strtoupper($m->tipe) }}</td>
                <td>{{ $m->jumlah }}</td>
                <td>{{ $m->keterangan }}</td>
                <td>{{ $m->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection
