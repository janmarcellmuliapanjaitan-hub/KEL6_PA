@extends('layout.main')

@section('title','Testimoni')
@section('page-title','Kelola Testimoni')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Data Testimoni</h3>
        @if($menunggu > 0)
            <span class="badge badge-warning">{{ $menunggu }} Menunggu Persetujuan</span>
        @endif
    </div>

    <div class="card-body p-2">
        @if(session('success'))
            <div class="alert alert-success mb-2">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Ulasan</th>
                    <th width="140">Waktu</th>
                    <th width="120">Status</th>
                    <th width="170">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonis as $testimoni)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $testimoni->nama }}</td>
                    <td>{{ $testimoni->email }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($testimoni->ulasan,60) }}</td>
                    <td>{{ $testimoni->tanggal }}</td>
                    <td>
                        @if($testimoni->status)
                            <span class="badge badge-success">Ditampilkan</span>
                        @else
                            <span class="badge badge-warning">Menunggu</span>
                        @endif
                    </td>
                    <td>
                        @if(!$testimoni->status)
                            <a href="{{ route('admin.testimoni.approve',$testimoni->id) }}" 
                               class="btn btn-success btn-sm"
                               onclick="return confirm('Setujui testimoni ini?')">
                               <i class="fas fa-check"></i>
                            </a>
                        @endif

                        <form action="{{ route('admin.testimoni.destroy',$testimoni->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus testimoni ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data testimoni</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection