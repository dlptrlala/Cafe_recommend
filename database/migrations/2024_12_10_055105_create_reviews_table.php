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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('idReview');
            $table->foreignId('idCafe')->constrained('cafes', 'idCafe')->onDelete('cascade');
            $table->text('name')->nullable();
            $table->text('email')->nullable();
            $table->decimal('rating')->unsigned(); // Rating dari 1-5
            $table->text('review')->nullable();
            $table->timestamps(); // Akan otomatis menyimpan `created_at` dan `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
