<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ── Relasi ──────────────────────────────
    // Satu kategori punya banyak menu
    public function menus()
    {
        return $this->hasMany(Menu::class)->where('is_active', true)->orderBy('urutan');
    }

    // Semua menu (termasuk yang nonaktif, untuk admin)
    public function semuaMenu()
    {
        return $this->hasMany(Menu::class)->orderBy('urutan');
    }

    // ── Scope ───────────────────────────────
    // Ambil hanya kategori yang aktif, urut berdasarkan kolom urutan
    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }

    // ── Auto-generate slug ───────────────────
    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}