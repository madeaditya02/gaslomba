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
        Schema::create('peserta_pendaftaran', function (Blueprint $table) {
            $table->foreignId('id_peserta');
            $table->foreignId('id_pendaftaran');
            $table->string('berkas_identitas');
            $table->enum('role', ['Ketua', 'Anggota']);
            $table->foreign('id_peserta')->references('id_peserta')->on('peserta')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_pendaftaran')->references('id')->on('pendaftaran')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_pendaftaran');
    }
};
