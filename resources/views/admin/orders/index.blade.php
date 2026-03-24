@extends('layout.main')

@section('title','Data Pesanan')
@section('page-title','Pesanan Masuk')

@section('content')
<div class="row">
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
                                <th>Waktu</th>
                                <th width="150">Aksi</th>
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
                                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus pesanan ini secara permanen?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada pesanan masuk.</td>
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
