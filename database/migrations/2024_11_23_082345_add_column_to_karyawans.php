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
        Schema::table('karyawans', function (Blueprint $table) {
            $table->text('pelatihan1')->nullable();
            $table->text('pelatihan2')->nullable();
            $table->text('pengalaman1')->nullable();
            $table->text('pengalaman2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropColumn('pelatihan1');
            $table->dropColumn('pelatihan2');
            $table->dropColumn('pengalaman1');
            $table->dropColumn('pengalaman2');
        });
    }
};
