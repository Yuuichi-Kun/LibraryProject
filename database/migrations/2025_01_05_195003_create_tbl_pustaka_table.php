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
        Schema::create('tbl_pustaka', function (Blueprint $table) {
            $table->id('id_pustaka');
            $table->unsignedBigInteger('id_ddc');
            $table->unsignedBigInteger('id_format');
            $table->unsignedBigInteger('id_penerbit');
            $table->unsignedBigInteger('id_pengarang');
            $table->string('isbn', 20);
            $table->string('judul_pustaka', 100);
            $table->string('tahun_terbit', 4);
            $table->string('keyword', 50);
            $table->string('keterangan_fisik', 100)->nullable();
            $table->string('keterangan_tambahan', 100)->nullable();
            $table->text('abstraksi')->nullable();
            $table->text('gambar')->nullable();
            $table->integer('harga_buku');
            $table->string('kondisi_buku', 15);
            $table->enum('fp', ['0', '1']);
            $table->tinyInteger('jml_pinjam');
            $table->integer('denda_terlambat');
            $table->integer('denda_hilang');
            $table->foreign('id_ddc')->references('id_ddc')->on('tbl_ddc');
            $table->foreign('id_format')->references('id_format')->on('tbl_format');
            $table->foreign('id_penerbit')->references('id_penerbit')->on('tbl_penerbit');
            $table->foreign('id_pengarang')->references('id_pengarang')->on('tbl_pengarang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pustaka');
    }
};
