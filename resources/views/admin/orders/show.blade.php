@extends('layout.main')

@section('title','Detail Pesanan')
@section('page-title','Detail Order: ' . $order->order_number)

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Informasi Pelanggan</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><th>Nama</th><td>{{ $order->name }}</td></tr>
                    <tr><th>WhatsApp</th><td><a href="https://wa.me/{{ $order->whatsapp_number }}" target="_blank">{{ $order->whatsapp_number }}</a></td></tr>
                    <tr><th>Tipe</th><td><span class="badge badge-primary">{{ $order->delivery_type }}</span></td></tr>
                    @if($order->delivery_type === 'Delivery')
                    <tr><th>Alamat</th><td>{{ $order->address }}</td></tr>
                    @endif
                    <tr><th>Waktu</th><td>{{ $order->created_at->format('d F Y, H:i') }}</td></tr>
                    <tr><th>Catatan</th><td>{{ $order->notes ?: '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Daftar Item Menu</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-default">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Menu</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Qty</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->menu)
                                    <strong>{{ $item->menu->name }}</strong>
                                @else
                                    <span class="text-danger">Menu Dihapus</span>
                                @endif
                            </td>
                            <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">TOTAL</th>
                            <th class="text-right text-success" style="font-size:1.2rem;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
