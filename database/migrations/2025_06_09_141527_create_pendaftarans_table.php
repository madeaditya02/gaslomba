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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('bukti_pembayaran');
            $table->enum('status', ['Pending', 'Rejected', 'Accepted']);
            $table->text('catatan_panitia')->nullable();
            $table->foreignId('id_cablom');
            $table->foreign('id_cablom')->references('id_cablom')->on('cabang_lomba');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
