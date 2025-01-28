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
        Schema::create('tbl_ddc', function (Blueprint $table) {
            $table->id('id_ddc');
            $table->unsignedBigInteger('id_rak');
            $table->string('kode_ddc', 10)->unique();
            $table->string('ddc', 100)->unique();
            $table->string('keterangan', 100)->nullable();
            $table->foreign('id_rak')->references('id_rak')->on('tbl_rak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ddc');
    }
};
