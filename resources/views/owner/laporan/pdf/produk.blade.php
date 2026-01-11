<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Produk Paling Laku</title>
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

        .right { text-align: right; }
        .center { text-align: center; }
    </style>
</head>
<body>

<h3>LAPORAN PRODUK PALING LAKU</h3>
<hr>

<table>
    <thead>
        <tr>
           <tr>
                    <th>Rank</th>
                    <th>Produk</th>
                    <th>Total Terjual</th>
                    <th>Omzet</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $i => $p)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->total_terjual }}</td>
                    <td>Rp {{ number_format($p->omzet,0,',','.') }}</td>
                </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
