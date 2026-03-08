<?php
// database/migrations/2024_03_08_000001_create_contacts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('no_telepon');
            $table->text('alamat');
            $table->string('jadwal'); // Contoh: "Senin - Jumat: 08.00 - 20.00"
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};