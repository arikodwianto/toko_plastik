<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            width: 58mm;
            margin: 0 auto;
        }
        .center { text-align: center; }
        .right { text-align: right; }
        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 6px 0;
        }
        table {
            width: 100%;
        }
        td {
            vertical-align: top;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="center">
        <strong>NAMA TOKO</strong><br>
        Alamat Toko<br>
        Telp: 08xxxxxxxx
    </div>

    <hr>

    <div>
        <div>Kode : {{ $penjualan->kode_transaksi }}</div>
        <div>Tgl  : {{ $penjualan->tanggal }}</div>
        <div>Kasir: {{ $penjualan->kasir->name ?? '-' }}</div>
    </div>

    <hr>

    <table>
        @foreach($penjualan->details as $d)
        <tr>
            <td colspan="2">{{ $d->barang->nama }}</td>
        </tr>
        <tr>
            <td>
                {{ $d->qty }} x {{ number_format($d->harga) }}
            </td>
            <td class="right">
                {{ number_format($d->subtotal) }}
            </td>
        </tr>
        @endforeach
    </table>

    <hr>

    <table>
        <tr>
            <td>Total</td>
            <td class="right">{{ number_format($penjualan->total) }}</td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="right">{{ number_format($penjualan->bayar) }}</td>
        </tr>
        <tr>
            <td>Kembali</td>
            <td class="right">{{ number_format($penjualan->kembalian) }}</td>
        </tr>
        <tr>
            <td>Metode</td>
            <td class="right">{{ strtoupper($penjualan->metode_pembayaran) }}</td>
        </tr>
    </table>

    <hr>

    <div class="center">
        *** TERIMA KASIH ***<br>
        Barang yang sudah dibeli<br>
        tidak dapat dikembalikan
    </div>

</body>
</html>
<script>
    window.onload = function () {
        window.print();

        // Setelah print, redirect ke riwayat
        setTimeout(function () {
            window.location.href = "{{ route('admin_kasir.penjualan.riwayat') }}";
        }, 1000);
    };
</script>
