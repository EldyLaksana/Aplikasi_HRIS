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
        Schema::create('karyawan_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departemen_id');
            $table->string('foto')->nullable();
            $table->string('no_id');
            $table->string('status_pegawai');
            $table->string('jabatan');
            $table->string('nama');
            $table->string('ktp');
            $table->string('kk');
            $table->string('file_ktp')->nullable();
            $table->string('file_kk')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->string('bpjs_ketenagakerjaan')->nullable();
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('pendidikan');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('alamat');
            $table->date('tanggal_masuk');
            $table->date('kontrak')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('x')->nullable();
            $table->string('nama1')->nullable();
            $table->string('status1')->nullable();
            $table->string('telepon1')->nullable();
            $table->string('nama2')->nullable();
            $table->string('status2')->nullable();
            $table->string('telepon2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_keluars');
    }
};
