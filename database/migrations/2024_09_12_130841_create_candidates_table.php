<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama gabungan kandidat (opsional)
            $table->foreignId('ketua_id')->constrained('users')->onDelete('cascade'); // Ketua dari tabel users
            $table->foreignId('wakil_id')->nullable()->constrained('users')->onDelete('cascade'); // Wakil dari tabel users
            $table->text('visi');
            $table->text('misi');
            $table->string('image')->nullable(); // Kolom untuk menyimpan path/URL gambar kandidat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
}   

