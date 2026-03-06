<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->text('ulasan');
            $table->boolean('status')->default(false); // false = menunggu, true = ditampilkan
            $table->timestamps(); // otomatis ada created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonis');
    }
};