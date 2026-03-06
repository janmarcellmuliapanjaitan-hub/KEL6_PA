<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimonis';
    
    protected $fillable = [
        'nama', 'email', 'ulasan', 'status'
    ];

    // Format tanggal Indonesia
    public function getTanggalAttribute()
    {
        return $this->created_at->format('d M Y H:i');
    }
}