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
        Schema::create('peserta', function (Blueprint $table) {
            $table->id('id_peserta');
            $table->string('nama');
            $table->string('kode_identitas');
            $table->string('no_telepon');
            $table->string('tingkatan');
            $table->string('profile_picture');
            $table->foreignId('id_akun')->nullable();
            $table->string('asal_instansi')->nullable();
            $table->foreign('tingkatan')->references('id_tingkatan')->on('tingkatan');
            $table->foreign('id_akun')->references('id_akun')->on('akun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
