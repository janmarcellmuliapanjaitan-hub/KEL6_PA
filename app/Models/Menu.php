<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'category_id',
        'kode',
        'nama',
        'deskripsi',
        'harga',
        'gambar',
        'badge',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'harga'     => 'integer',
    ];

    // ── Relasi ──────────────────────────────
    // Menu dimiliki oleh satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ── Scope ───────────────────────────────
    // Hanya menu yang aktif
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    // Filter berdasarkan kategori
    public function scopeByKategori($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // ── Accessor ────────────────────────────
    // Format harga otomatis: Rp 25.000
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // URL gambar — jika URL eksternal langsung pakai, jika path lokal pakai storage
    public function getGambarUrlAttribute(): string
    {
        if (!$this->gambar) {
            return 'https://placehold.co/400x300?text=No+Image';
        }

        if (str_starts_with($this->gambar, 'http')) {
            return $this->gambar;
        }

        return asset('storage/' . $this->gambar);
    }
}
