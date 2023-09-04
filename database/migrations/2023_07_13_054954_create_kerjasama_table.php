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
        Schema::create('kerjasama', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('jenis');
            $table->string('status');
            $table->integer('durasi');
            $table->foreignId('bidang');
            $table->date('tanggal_awal')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->foreignId('id_mitra');
            $table->string('deskripsi')->nullable();
            $table->foreignId('id_mou')->nullable();
            $table->foreignId('id_user');
            $table->foreignId('id_dokumen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerjasama');
    }
};
