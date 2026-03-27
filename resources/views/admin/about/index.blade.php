@extends('layout.main')

@section('title','About Us')
@section('page-title','Kelola About Us')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Data About Us</h3>

                @if(!$about)
                    <a href="{{ route('admin.about.create') }}" class="btn btn-light btn-sm ml-auto text-primary">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                @endif
            </div>

            <div class="card-body">

                {{-- ALERT --}}
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

                {{-- DATA ADA --}}
                @if($about)

                <div class="row">

                    <div class="col-md-4 text-center mb-3">
                        @if($about->gambar)
                            <img src="{{ asset('uploads/about/'.$about->gambar) }}" 
                                 class="img-fluid img-thumbnail shadow-sm" style="max-height: 250px; object-fit: cover;">
                        @else
                            <div class="bg-light p-5 text-muted border rounded">
                                <i class="fas fa-image fa-2x mb-2"></i><br>
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>

                    <div class="col-md-8">

                        <table class="table table-bordered table-striped">

                            <tr>
                                <th width="150" class="align-middle">Judul</th>
                                <td class="align-middle">{{ $about->judul }}</td>
                            </tr>

                            <tr>
                                <th class="align-middle">Deskripsi</th>
                                <td class="align-middle">{!! nl2br(e($about->deskripsi)) !!}</td>
                            </tr>

                        </table>

                        <div class="mt-3">
                            <a href="{{ route('admin.about.edit', $about->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('admin.about.destroy', $about->id) }}" 
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus data About Us ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>

                    </div>

                </div>

                {{-- DATA KOSONG --}}
                @else

                <div class="text-center p-5 border rounded bg-light">
                    <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada data About Us.</h5>
                    <a href="{{ route('admin.about.create') }}" class="btn btn-primary btn-sm mt-2">
                        <i class="fas fa-plus"></i> Tambah Data Sekarang
                    </a>
                </div>

                @endif

            </div>

        </div>

    </div>
</div>

@endsection