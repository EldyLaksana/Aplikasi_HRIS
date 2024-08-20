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
        Schema::create('cuti_karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('no_id');
            $table->string('departemen');
            $table->string('nama');
            $table->foreignId('karyawan_id');
            $table->string('cuti');
            $table->string('tanggal_cuti');
            $table->integer('jumlah_hari');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti_karyawans');
    }
};
