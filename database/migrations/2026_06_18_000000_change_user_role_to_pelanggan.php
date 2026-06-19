<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Temporarily change the enum to allow 'admin', 'user', and 'pelanggan'
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user', 'pelanggan') DEFAULT 'pelanggan'");

        // 2. Update existing 'user' records to 'pelanggan'
        DB::table('users')->where('role', 'user')->update(['role' => 'pelanggan']);

        // 3. Finalize the enum to remove 'user' entirely
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pelanggan') DEFAULT 'pelanggan'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Temporarily allow 'user' back in the enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user', 'pelanggan') DEFAULT 'user'");

        // 2. Rollback 'pelanggan' back to 'user'
        DB::table('users')->where('role', 'pelanggan')->update(['role' => 'user']);

        // 3. Revert the enum to its original state
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user') DEFAULT 'user'");
    }
};
