@extends('layout.main')

@section('title','Kelola Lokasi')
@section('page-title','Data Lokasi Peta')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Daftar Titik Lokasi</h3>
                <a href="{{ route('admin.locations.create') }}" class="btn btn-light btn-sm ml-auto text-primary">
                    <i class="fas fa-plus"></i> Tambah Lokasi
                </a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Tempat</th>
                                <th>Alamat</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($locations) > 0)
                                @foreach($locations as $location)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $location->name }}</td>
                                    <td class="align-middle text-left">{{ Str::limit($location->address, 50) }}</td>
                                    <td class="align-middle">{{ $location->latitude }}</td>
                                    <td class="align-middle">{{ $location->longitude }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus lokasi ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data lokasi.</td>
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
