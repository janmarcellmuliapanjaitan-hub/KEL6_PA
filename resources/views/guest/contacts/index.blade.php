{{-- resources/views/guest/contacts/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kontak Kami')

@push('styles')
<style>
  .contact-section { padding: 5rem 0; text-align: center; }

  .contact-label {
    font-size: .7rem; letter-spacing: .2em; text-transform: uppercase;
    color: #999; margin-bottom: .5rem;
  }

  .contact-title {
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 400; color: #222; margin-bottom: 3rem;
  }
  .contact-title span { color: var(--bs-danger); font-weight: 600; }

  /* Info Cards */
  .info-card {
    display: flex; align-items: center; gap: 1rem;
    border: 1px solid #e8e8e8; border-radius: 8px;
    padding: 1.25rem 1.5rem; background: #fff;
    text-align: left; height: 100%;
    transition: box-shadow .2s;
  }
  .info-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.08); }

  .info-icon {
    width: 46px; height: 46px; border-radius: 50%;
    background: #e8192c; color: #fff; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
  }

  .info-card h6 { font-weight: 600; font-size: .9rem; color: #222; margin-bottom: .2rem; }
  .info-card p, .info-card a { font-size: .85rem; color: #666; margin: 0; text-decoration: none; }
  .info-card a:hover { color: #e8192c; }

  /* Footer strip */
  .contact-footer { background: #1e1e2e; color: rgba(255,255,255,.6); padding: 1.5rem 0; text-align: center; font-size: .82rem; }
</style>
@endpush

@section('content')

<div class="contact-section">
  <div class="container">

    <p class="contact-label">Contact</p>
    <h2 class="contact-title">Need Help? <span>Contact Us</span></h2>

    <div class="row g-3 justify-content-center">

      @forelse($contacts as $contact)

        {{-- Alamat --}}
        <div class="col-md-5">
          <div class="info-card">
            <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
            <div>
              <h6>Address</h6>
              <p>{{ $contact->alamat }}</p>
            </div>
          </div>
        </div>

        {{-- Email --}}
        <div class="col-md-5">
          <div class="info-card">
            <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
            <div>
              <h6>Email Us</h6>
              <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
            </div>
          </div>
        </div>

        {{-- Telepon --}}
        <div class="col-md-5">
          <div class="info-card">
            <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
            <div>
              <h6>Call Us</h6>
              <a href="tel:{{ $contact->no_telepon }}">{{ $contact->no_telepon }}</a>
            </div>
          </div>
        </div>

        {{-- Jam Operasional --}}
        <div class="col-md-5">
          <div class="info-card">
            <div class="info-icon"><i class="bi bi-clock-fill"></i></div>
            <div>
              <h6>Opening Hours</h6>
              <p>Senin - Minggu: 08.00 - 22.00</p>
            </div>
          </div>
        </div>

      @empty
        <div class="col-12">
          <p class="text-muted">Saat ini belum ada informasi kontak yang tersedia.</p>
        </div>
      @endforelse

    </div>
  </div>
</div>

@endsection