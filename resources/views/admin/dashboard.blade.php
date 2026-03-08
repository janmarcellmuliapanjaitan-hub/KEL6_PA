@extends('layout.main')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stat Cards -->
    <div class="col-md-3">
        <div class="stat-card d-flex align-items-center">
            <div class="stat-icon me-3">
                <i class="bi bi-cup"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Total Menu</h6>
                <h3 class="mb-0">24</h3>
                <small class="text-success">+3 baru</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card d-flex align-items-center">
            <div class="stat-icon me-3">
                <i class="bi bi-star"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Testimoni</h6>
                <h3 class="mb-0">18</h3>
                <small class="text-success">+5 baru</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card d-flex align-items-center">
            <div class="stat-icon me-3">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Pengunjung</h6>
                <h3 class="mb-0">1.2k</h3>
                <small class="text-success">+200</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card d-flex align-items-center">
            <div class="stat-icon me-3">
                <i class="bi bi-chat"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1">Pesan Masuk</h6>
                <h3 class="mb-0">7</h3>
                <small class="text-danger">+2 belum dibaca</small>
            </div>
        </div>
    </div>
</div>

<!-- Menu Terbaru -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Menu Terbaru</h6>
              
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kopi Batak</td>
                            <td>Kopi</td>
                            <td>Rp 25.000</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                        </tr>
                        <tr>
                            <td>Caffè Latte</td>
                            <td>Kopi</td>
                            <td>Rp 28.000</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                        </tr>
                        <tr>
                            <td>French Fries</td>
                            <td>Snack</td>
                            <td>Rp 20.000</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                        </tr>
                        <tr>
                            <td>Nasi Goreng</td>
                            <td>Rice Bowl</td>
                            <td>Rp 35.000</td>
                            <td><span class="badge bg-warning">Habis</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Testimoni Terbaru -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Testimoni Terbaru</h6>
                <a href="{{ route('admin.testimoni.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <div class="list-group-item border-0">
                        <div class="d-flex">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" width="40" height="40" class="rounded-circle me-3">
                            <div>
                                <h6 class="mb-1">Budi Santoso</h6>
                                <p class="small text-muted mb-1">"Tempatnya nyaman, kopinya enak!"</p>
                                <small class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item border-0">
                        <div class="d-flex">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" width="40" height="40" class="rounded-circle me-3">
                            <div>
                                <h6 class="mb-1">Siti Aminah</h6>
                                <p class="small text-muted mb-1">"Pelayanan ramah, harga terjangkau"</p>
                                <small class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
               
            </div>
        </div>
    </div>
</div>
@endsection