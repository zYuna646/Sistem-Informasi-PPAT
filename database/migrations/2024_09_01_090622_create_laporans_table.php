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
        Schema::create('laporans', function (Blueprint $table) {
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
            $table->foreignId('pelaporan_id')->constrained('pelaporans')->onDelete('cascade');
            $table->date('deadline');
            $table->string('status')->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
