@extends('layouts.admin')

@section('title', 'Tambah About Us')
@section('page-title', 'Tambah About Us')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                               value="{{ old('judul') }}" placeholder="Contoh: Tentang Janji Martahan Coffee" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun Berdiri</label>
                                <input type="text" name="tahun_berdiri" class="form-control" 
                                       value="{{ old('tahun_berdiri') }}" placeholder="Contoh: 2020">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" 
                                       value="{{ old('lokasi') }}" placeholder="Contoh: Balige, Sumatera Utara">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Format: jpeg, png, jpg. Max: 2MB</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sejarah <span class="text-danger">*</span></label>
                        <textarea name="sejarah" rows="5" class="form-control @error('sejarah') is-invalid @enderror" 
                                  placeholder="Tulis sejarah singkat cafe di sini..." required>{{ old('sejarah') }}</textarea>
                        @error('sejarah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Visi</label>
                        <textarea name="visi" rows="4" class="form-control" 
                                  placeholder="Tulis visi cafe di sini...">{{ old('visi') }}</textarea>
                    </div>

                    <hr>
                    <h5 class="mb-3">How to Order (Cara Memesan) <span class="text-danger">*</span></h5>
                    <p class="text-muted small">Tuliskan langkah-langkah cara memesan. Gunakan &lt;br&gt; untuk baris baru dan nomor untuk urutan.</p>
                    
                    <div class="mb-3">
                        <label class="form-label">Langkah-langkah</label>
                        <textarea name="how_to_order" rows="8" class="form-control @error('how_to_order') is-invalid @enderror" 
                                  placeholder="Contoh:
1. Chat admin sesuai dengan kebutuhan, dan menginformasikan rencana tanggal yang diinginkan
<br>
2. Apabila tanggal yang diinginkan tersedia, proses diskusi design akan dilanjutkan dan detail harga akan disampaikan oleh admin
<br>
3. Setelah customer setuju dengan penawaran yang diberikan, form order akan di share oleh admin
<br>
4. Setelah form order diisi, admin akan merekam dan mentotalkannya
<br>
5. Pesanan akan diproses apabila customer sudah melakukan pembayaran melalui bank transfer" required>{{ old('how_to_order') }}</textarea>
                        @error('how_to_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection