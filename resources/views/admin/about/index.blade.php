@extends('layout.main')

@section('title','About Us')
@section('page-title','Kelola About Us')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">

            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Data About Us</h3>

                @if(!$about)
                <a href="{{ route('admin.about.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                @endif
            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($about)

                <div class="row">

                    <div class="col-md-4">

                        @if($about->gambar)
                        <img src="{{ asset('uploads/about/'.$about->gambar) }}" 
                             class="img-fluid img-thumbnail">
                        @else
                        <div class="bg-light text-center p-5">
                            Tidak ada gambar
                        </div>
                        @endif

                    </div>

                    <div class="col-md-8">

                        <table class="table table-bordered">

                            <tr>
                                <th width="150">Judul</th>
                                <td>{{ $about->judul }}</td>
                            </tr>

                            <tr>
                                <th>Deskripsi</th>
                                <td>{!! nl2br(e($about->deskripsi)) !!}</td>
                            </tr>

                        </table>

                        <a href="{{ route('admin.about.edit',$about->id) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('admin.about.destroy',$about->id) }}" 
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger"
                                    onclick="return confirm('Yakin hapus data?')">

                                <i class="fas fa-trash"></i> Hapus
                            </button>

                        </form>

                    </div>

                </div>

                @else

                <div class="text-center p-5">

                    <h5>Belum ada data About Us</h5>

                    <a href="{{ route('admin.about.create') }}" 
                       class="btn btn-primary mt-3">

                        Tambah Data
                    </a>

                </div>

                @endif

            </div>

        </div>

    </div>
</div>

@endsection