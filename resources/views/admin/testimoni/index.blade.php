@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kelola Testimoni</h2>
        @if($menunggu > 0)
            <span class="badge bg-warning">{{ $menunggu }} Menunggu Persetujuan</span>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Ulasan</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonis as $index => $testimoni)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $testimoni->nama }}</td>
                        <td>{{ $testimoni->email }}</td>
                        <td>{{ Str::limit($testimoni->ulasan, 50) }}</td>
                        <td>{{ $testimoni->tanggal }}</td>
                        <td>
                            @if($testimoni->status)
                                <span class="badge bg-success">Ditampilkan</span>
                            @else
                                <span class="badge bg-warning">Menunggu</span>
                            @endif
                        </td>
                        <td>
                            @if(!$testimoni->status)
                                <a href="{{ route('admin.testimoni.approve', $testimoni->id) }}" 
                                   class="btn btn-sm btn-success"
                                   onclick="return confirm('Setujui testimoni ini?')">
                                    Setujui
                                </a>
                            @endif
                            
                            <form action="{{ route('admin.testimoni.destroy', $testimoni->id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Hapus testimoni ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection