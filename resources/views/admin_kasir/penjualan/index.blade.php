@extends('layouts.kasir-app')

@section('content')
<main class="app-main">

    {{-- Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Kasir / Penjualan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('kasir.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Kasir</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="app-content">
        <div class="container-fluid">

            {{-- Cari Barang --}}
            <div class="card shadow-sm border-0 rounded-3 mb-3">
                <div class="card-body">
                    <input type="text" id="cariBarang" class="form-control form-control-lg" placeholder="Scan barcode / ketik nama barang">
                </div>
            </div>

            {{-- Keranjang --}}
            <div class="card shadow-sm border-0 rounded-3 mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-cart me-2"></i> Keranjang</h5>
                </div>
                <div class="card-body p-3 table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0" id="dataTable">
                        <thead class="table-primary">
                            <tr>
                                <th>Barang</th>
                                <th width="120">Harga</th>
                                <th width="80">Qty</th>
                                <th width="120">Diskon</th>
                                <th width="150">Subtotal</th>
                                <th width="60" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cartBody"></tbody>
                    </table>
                </div>
            </div>

            {{-- Pembayaran --}}
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-cash-stack me-2"></i> Pembayaran</h5>
                </div>
                <div class="card-body row g-3">

                    <div class="col-md-4">
                        <label class="form-label">Diskon Total</label>
                        <input type="number" id="diskon_total" class="form-control" value="0">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Metode Pembayaran</label>
                        <select id="metode_pembayaran" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Total Bayar</label>
                        <input type="text" id="totalBayar" class="form-control form-control-lg fw-bold" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Uang Bayar</label>
                        <input type="number" id="bayar" class="form-control form-control-lg">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Kembalian</label>
                        <input type="text" id="kembalian" class="form-control form-control-lg fw-bold" readonly>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-success btn-lg w-100" onclick="simpanTransaksi()">
                            <i class="bi bi-save me-1"></i> SIMPAN TRANSAKSI
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>

</main>
@endsection

@push('scripts')
<script>
function formatRupiah(angka){
    return new Intl.NumberFormat('id-ID').format(angka);
}


let cart = [];

document.getElementById('cariBarang').addEventListener('keypress', function(e){
    if(e.key === 'Enter'){
        cariBarang(this.value);
        this.value = '';
    }
});

function cariBarang(keyword){
    fetch(`{{ route('admin_kasir.penjualan.cari') }}?q=${keyword}`)
    .then(res => res.json())
    .then(barang => {
        if(!barang){
            alert('Barang tidak ditemukan / stok habis');
            return;
        }

        let existing = cart.find(i => i.id === barang.id);
        if(existing){
            existing.qty++;
        } else {
            cart.push({
                id: barang.id,
                nama: barang.nama,
                harga: barang.harga_jual,
                qty: 1,
                diskon: 0
            });
        }
        renderCart();
    });
}

function renderCart(){
    let body = document.getElementById('cartBody');
    body.innerHTML = '';
    let total = 0;

    cart.forEach((item, index) => {
        let subtotal = (item.harga * item.qty) - item.diskon;
        total += subtotal;

        body.innerHTML += `
            <tr>
                <td>${item.nama}</td>
                <td>Rp ${formatRupiah(item.harga)}</td>
                <td>
                    <input type="number" min="1" value="${item.qty}" class="form-control" onchange="updateQty(${index}, this.value)">
                </td>
                <td>
                    <input type="number" min="0" value="${item.diskon}" class="form-control" onchange="updateDiskon(${index}, this.value)">
                </td>
                <td>Rp ${formatRupiah(subtotal)}</td>
                <td class="text-center">
                    <button class="btn btn-danger btn-sm" onclick="hapusItem(${index})">✖</button>
                </td>
            </tr>
        `;
    });

    let diskonTotal = Number(document.getElementById('diskon_total').value);
    total -= diskonTotal;

    document.getElementById('totalBayar').value = 'Rp ' + formatRupiah(total);
    hitungKembalian();
}

function updateQty(i, val){ cart[i].qty = Number(val); renderCart(); }
function updateDiskon(i, val){ cart[i].diskon = Number(val); renderCart(); }
function hapusItem(i){ cart.splice(i, 1); renderCart(); }

document.getElementById('diskon_total').addEventListener('input', renderCart);
document.getElementById('bayar').addEventListener('input', hitungKembalian);

function hitungKembalian(){
    let bayar = Number(document.getElementById('bayar').value);
    let total = Number(document.getElementById('totalBayar').value.replace(/[^0-9]/g, ''));
    document.getElementById('kembalian').value = 'Rp ' + formatRupiah(bayar - total);
}

function simpanTransaksi(){
    if(cart.length === 0){ alert('Keranjang kosong'); return; }

    fetch(`{{ route('admin_kasir.penjualan.store') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            items: cart.map(i => ({ barang_id: i.id, qty: i.qty, diskon: i.diskon })),
            diskon_total: document.getElementById('diskon_total').value,
            total_bayar: Number(
    document.getElementById('totalBayar')
        .value.replace(/[^0-9]/g, '')
),

            bayar: document.getElementById('bayar').value,
            metode_pembayaran: document.getElementById('metode_pembayaran').value
        })
    })
    .then(res => res.ok ? res.json() : res.json().then(e => Promise.reject(e)))
    .then(data => alert(data.message))
    .catch(err => alert(err.message));
}



</script>
@endpush
