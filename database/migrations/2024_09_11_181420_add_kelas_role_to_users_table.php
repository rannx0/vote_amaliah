<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the new columns
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('set null'); // Relasi ke tabel kelas
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Relasi ke tabel roles
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign keys and columns on rollback
            $table->dropForeign(['kelas_id']);
            $table->dropForeign(['role_id']);
            $table->dropColumn('kelas_id');
            $table->dropColumn('role_id');
        });
    }
};
