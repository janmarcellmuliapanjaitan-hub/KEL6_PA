<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'judul',
        'sejarah',
        'visi',
        'how_to_order',
        'gambar',
        'tahun_berdiri',
        'lokasi'
    ];
}