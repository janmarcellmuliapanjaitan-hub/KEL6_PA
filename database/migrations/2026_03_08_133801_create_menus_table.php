<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade'); // hapus menu jika kategori dihapus

            $table->string('kode')->unique();     // Contoh: C001, F001, N001
            $table->string('nama');               // Nama menu
            $table->text('deskripsi')->nullable(); // Deskripsi singkat
            $table->integer('harga');             // Harga dalam rupiah
            $table->string('gambar')->nullable(); // Path foto (storage) atau URL
            $table->string('badge')->nullable();  // Contoh: Best Seller, New, Populer
            $table->boolean('is_active')->default(true); // Tampil/sembunyikan menu
            $table->integer('urutan')->default(0); // Urutan tampil di grid
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};