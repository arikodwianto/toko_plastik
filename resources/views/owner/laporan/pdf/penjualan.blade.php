<h3>Laporan Penjualan</h3>
<hr>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Kode</th>
            <th>Kasir</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($penjualans as $p)
        <tr>
            <td>{{ $p->tanggal }}</td>
            <td>{{ $p->kode_transaksi }}</td>
            <td>{{ $p->kasir->name ?? '-' }}</td>
            <td>Rp {{ number_format($p->total,0,',','.') }}</td>
        

        </tr>
        @endforeach
    </tbody>
</table>
