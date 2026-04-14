@extends('layout.main')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')



<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <h6 class="mb-0">Halaman</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.menu.index') }}" class="text-decoration-none">
                            <div class="card bg-info text-white text-center p-3 h-100 shadow-sm border-0" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <i class="fas fa-utensils fa-2x mb-2"></i>
                                    <h6 class="mb-0">Kelola Menu</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
                            <div class="card bg-success text-white text-center p-3 h-100 shadow-sm border-0" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                                    <h6 class="mb-0">Kelola Pesanan</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.promo.index') }}" class="text-decoration-none">
                            <div class="card bg-warning text-white text-center p-3 h-100 shadow-sm border-0" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <i class="fas fa-tags fa-2x mb-2"></i>
                                    <h6 class="mb-0">Kelola Promo</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.gallery.index') }}" class="text-decoration-none">
                            <div class="card bg-primary text-white text-center p-3 h-100 shadow-sm border-0" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <i class="fas fa-images fa-2x mb-2"></i>
                                    <h6 class="mb-0">Kelola Galeri</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.locations.index') }}" class="text-decoration-none">
                            <div class="card bg-danger text-white text-center p-3 h-100 shadow-sm border-0" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <i class="fas fa-map-marker-alt fa-2x mb-2"></i>
                                    <h6 class="mb-0">Kelola Lokasi</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.testimoni.index') }}" class="text-decoration-none">
                            <div class="card bg-secondary text-white text-center p-3 h-100 shadow-sm border-0" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <i class="fas fa-star fa-2x mb-2"></i>
                                    <h6 class="mb-0">Kelola Testimoni</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.about.index') }}" class="text-decoration-none">
                            <div class="card bg-dark text-white text-center p-3 h-100 shadow-sm border-0" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <i class="fas fa-info-circle fa-2x mb-2"></i>
                                    <h6 class="mb-0">Kelola Tentang Kami</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-3">
                        <a href="{{ route('admin.contacts.index') }}" class="text-decoration-none">
                            <div class="card bg-light text-dark text-center p-3 h-100 shadow-sm border" style="transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <i class="fas fa-address-book fa-2x mb-2"></i>
                                    <h6 class="mb-0">Kelola Kontak</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection