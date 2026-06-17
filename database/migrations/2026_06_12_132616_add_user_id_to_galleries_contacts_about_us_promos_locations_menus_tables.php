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
        Schema::table('galleries', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });

        Schema::table('about_us', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });

        Schema::table('promos', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });

        // Populate existing data.
        $adminUser = DB::table('users')->where('role', 'admin')->first() ?: DB::table('users')->first();
        $adminId = $adminUser ? $adminUser->id : null;

        if ($adminId) {
            DB::table('galleries')->update(['user_id' => $adminId]);
            DB::table('about_us')->update(['user_id' => $adminId]);
            DB::table('promos')->update(['user_id' => $adminId]);
            DB::table('locations')->update(['user_id' => $adminId]);
            DB::table('menus')->update(['user_id' => $adminId]);
        }

        // Map existing contacts by email
        DB::table('contacts')->get()->each(function ($contact) use ($adminId) {
            $user = DB::table('users')->where('email', $contact->email)->first();
            $targetId = $user ? $user->id : $adminId;
            if ($targetId) {
                DB::table('contacts')->where('id', $contact->id)->update(['user_id' => $targetId]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('promos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('about_us', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
