<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pembelian</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h3 { text-align: center; margin-bottom: 5px; }
        hr { margin-bottom: 10px; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background: #f0f0f0;
            text-align: center;
        }

        td {
            vertical-align: top;
        }

        .right { text-align: right; }
    </style>
</head>
<body>

<h3>LAPORAN PEMBELIAN (STOK MASUK)</h3>
<hr>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Barang</th>
            <th>Supplier</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stokMasuk as $s)
        <tr>
            <td>{{ $s->tanggal_masuk }}</td>
            <td>{{ $s->barang->nama }}</td>
            <td>{{ $s->supplier ?? '-' }}</td>
            <td class="right">{{ $s->jumlah }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
