@extends('layout.main')

@section('title','Data Pesanan')
@section('page-title','Pesanan Masuk')

@section('content')
<div class="row">
    <!-- Permintaan Pesanan Baru Card -->
    @if(count($checkoutRequests) > 0)
    <div class="col-md-12 mb-4">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title text-warning font-weight-bold"><i class="fas fa-bell mr-2"></i> Permintaan Pesanan Baru (Menunggu Konfirmasi)</h3>
                <div class="card-tools">
                    <span class="badge badge-warning font-weight-bold" style="font-size: 0.9rem; padding: 5px 10px;">{{ count($checkoutRequests) }} Permintaan</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr style="background-color: rgba(255, 193, 7, 0.08);">
                                <th class="pl-3">No Order</th>
                                <th>Pelanggan</th>
                                <th>Tipe</th>
                                <th>Alamat</th>
                                <th>Total</th>
                                <th>Waktu Checkout</th>
                                <th width="150" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($checkoutRequests as $request)
                            <tr>
                                <td class="pl-3"><strong>{{ $request->order_number }}</strong></td>
                                <td>
                                    {{ $request->name }}<br>
                                    <small><a href="https://wa.me/{{ $request->whatsapp_number }}" target="_blank"><i class="fab fa-whatsapp"></i> {{ $request->whatsapp_number }}</a></small>
                                </td>
                                <td><span class="badge badge-info">{{ $request->delivery_type }}</span></td>
                                <td>{{ $request->address ?: '-' }}</td>
                                <td class="text-success font-weight-bold">Rp {{ number_format($request->total_price, 0, ',', '.') }}</td>
                                <td>{{ $request->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.confirm-wa-view', ['id' => $request->id]) }}" class="btn btn-warning btn-sm font-weight-bold px-3" style="border-radius: 4px;" onclick="return confirm('Konfirmasi pesanan ini dan masukkan ke database sebagai pending?')">
                                        <i class="fas fa-check-circle mr-1"></i> Konfirmasi
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Daftar Pesanan</h3>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No Order</th>
                                <th>Pelanggan</th>
                                <th>Tipe</th>
                                <th>Alamat</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Waktu</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_number }}</strong></td>
                                    <td>
                                        {{ $order->name }}<br>
                                        <small><a href="https://wa.me/{{ $order->whatsapp_number }}" target="_blank"><i class="fab fa-whatsapp"></i> {{ $order->whatsapp_number }}</a></small>
                                    </td>
                                    <td><span class="badge badge-info">{{ $order->delivery_type }}</span></td>
                                    <td>{{ filter_var($order->address, FILTER_SANITIZE_STRING) ?: '-' }}</td>
                                    <td class="text-success font-weight-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($order->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status == 'completed')
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($order->status == 'pending')
                                            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm" title="Setujui/Selesaikan" onclick="return confirm('Selesaikan pesanan ini?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-warning btn-sm" title="Batalkan" onclick="return confirm('Batalkan pesanan ini?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Hapus pesanan ini secara permanen?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada pesanan masuk.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
