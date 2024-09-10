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
        Schema::create('laporan_perorangans', function (Blueprint $table) {
            $table->id();
            $table->json('akta')->nullable();
            $table->json('npwp')->nullable();
            $table->string('bentuk_perbuatan_hukum')->nullable();
            $table->string('letak_tanah')->nullable();
            $table->string('harga_transaksi')->nullable();
            $table->json('sppt')->nullable();
            $table->json('ssp')->nullable();
            $table->json('ssb')->nullable();
            $table->string('ket')->nullable();
            $table->string('luas')->nullable();
            $table->string('jenis_nomor')->nullable();
            $table->string('status')->default('belum');
            $table->string('msg')->nullable();
            $table->foreignId('laporan_id')->constrained('laporans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_perorangans');
    }
};
