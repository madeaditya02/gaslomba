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
        Schema::create('cabang_lomba', function (Blueprint $table) {
            $table->id('id_cablom');
            $table->string('nama_cablom');
            $table->integer('jumlah_anggota');
            $table->integer('biaya');
            $table->foreignId('id_lomba');
            $table->foreign('id_lomba')->references('id_lomba')->on('lomba')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabang_lomba');
    }
};
