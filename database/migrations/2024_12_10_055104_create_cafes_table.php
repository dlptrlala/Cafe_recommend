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
        Schema::create('cafes', function (Blueprint $table) {
            $table->id('idCafe');
            $table->string('namaCafe');
            $table->string('gambarCafe')->nullable();
            $table->string('alamatCafe');
            $table->enum('lokasi_area', ['Bantul', 'Gunung Kidul', 'Kulon Progo', 'Sleman', 'Yogyakarta'])->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('hargaMin');
            $table->integer('hargaMax');
            $table->json('kebutuhan'); // JSON untuk menyimpan kategori kebutuhan
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->text('deskripsi');
            // $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafes');
    }
};
