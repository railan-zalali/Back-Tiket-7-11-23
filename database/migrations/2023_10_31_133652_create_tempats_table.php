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
        Schema::create('tempats', function (Blueprint $table) {
            $table->id('tempatId'); // Kolom ID sebagai primary key.
            $table->string('namaTempat');
            $table->string('alamat');
            $table->string('kota');
            $table->integer('kapasitas');
            $table->date('tanggal')->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('fotoTempat')->nullable();
            $table->string('kontak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempats');
    }
};
