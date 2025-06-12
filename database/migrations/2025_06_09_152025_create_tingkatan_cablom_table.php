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
        Schema::create('tingkatan_cablom', function (Blueprint $table) {
            $table->string('id_tingkatan');
            $table->foreignId('id_cablom');
            $table->foreign('id_tingkatan')->references('id_tingkatan')->on('tingkatan');
            $table->foreign('id_cablom')->references('id_cablom')->on('cabang_lomba');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tingkatan_cablom');
    }
};
