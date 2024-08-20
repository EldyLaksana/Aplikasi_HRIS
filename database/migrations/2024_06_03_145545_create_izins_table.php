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
        Schema::create('izins', function (Blueprint $table) {
            $table->id();
            $table->string('no_id');
            $table->string('departemen');
            $table->string('nama');
            $table->foreignId('karyawan_id');
            $table->date('tanggal');
            $table->string('izin');
            $table->time('jam')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('alasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izins');
    }
};
