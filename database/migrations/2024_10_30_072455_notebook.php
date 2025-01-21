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
        Schema::create('notebook', function (Blueprint $table) {
            $table->id();
            $table->string('processor');
            $table->string('merk');
            $table->string('memory');
            $table->string('harddisk');
            $table->string('dvd_cd_rw')->nullable();
            $table->string('layar');
            $table->string('wifi')->nullable();
            $table->string('webcam')->nullable();
            $table->string('tas')->nullable();
            $table->string('os');
            $table->string('antivirus')->nullable();
            $table->string('office')->nullable();
            $table->string('ip')->nullable();
            $table->string('user')->nullable();
            $table->string('bagian');
            $table->date('tanggalmasuk');
            $table->date('tanggalkeluar')->nullable();
            $table->integer('harga')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('kelompok');
            $table->string('departemenid');
            $table->string('stocknumber')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notebook');
    }
};
