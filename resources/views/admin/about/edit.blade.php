@extends('layout.main')

@section('title','Edit About Us')
@section('page-title','Edit About Us')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Form Edit About Us</h3>
            </div>

            <form action="{{ route('admin.about.update',$about->id) }}" 
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group">
                        <label>Judul</label>

                        <input type="text"
                               name="judul"
                               class="form-control"
                               value="{{ old('judul',$about->judul) }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>

                        <textarea name="deskripsi"
                                  rows="8"
                                  class="form-control"
                                  required>{{ old('deskripsi',$about->deskripsi) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar Baru</label>

                        <input type="file"
                               name="gambar"
                               class="form-control">
                    </div>

                    @if($about->gambar)

                    <div class="form-group">
                        <label>Gambar Saat Ini</label><br>

                        <img src="{{ asset('uploads/about/'.$about->gambar) }}"
                             width="150"
                             class="img-thumbnail">
                    </div>

                    @endif

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>

                    <a href="{{ route('admin.about.index') }}" 
                       class="btn btn-secondary">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection