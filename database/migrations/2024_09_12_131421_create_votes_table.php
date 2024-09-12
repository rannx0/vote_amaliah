<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Referensi ke user yang melakukan vote
            $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade'); // Referensi ke kandidat yang dipilih
            $table->timestamps();

            // Pastikan user hanya bisa memilih satu kandidat
            $table->unique('user_id'); // Hanya satu entri per pengguna
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
}


