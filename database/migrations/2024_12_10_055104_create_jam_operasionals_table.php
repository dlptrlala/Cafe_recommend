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
        Schema::create('jam_operasionals', function (Blueprint $table) {
            // $table->id('idJam');
            $table->foreignId('idCafe')->constrained('cafes', 'idCafe')->onDelete('cascade');
            $table->json('jadwal'); // Kolom JSON untuk menyimpan jadwal operasional
            // $table->timestamps(); // Kolom created_at dan updated_at
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jam_operasionals');
    }
};