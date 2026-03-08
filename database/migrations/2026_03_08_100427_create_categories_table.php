<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Contoh: Coffee, Makanan, Non Coffee
            $table->string('slug')->unique(); // Contoh: coffee, makanan, non-coffee
            $table->string('icon')->nullable(); // Emoji icon: ☕ 🍽️ 🥤
            $table->integer('urutan')->default(0); // Urutan tampil di tab
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};