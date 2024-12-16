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
        Schema::table('reviews', function (Blueprint $table) { // Perbaiki tabel menjadi 'reviews'
            $table->dropColumn('updated_at'); // Menghapus kolom updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) { // Perbaiki tabel menjadi 'reviews'
            $table->timestamp('updated_at')->nullable(); // Menambahkan kembali kolom updated_at
        });
    }
};
