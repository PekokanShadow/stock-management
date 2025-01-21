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
        Schema::create('komputer', function (Blueprint $table) {
            $table->id();
            $table->string('processor');
            $table->string('motherboard');
            $table->string('memory');
            $table->string('harddisk')->nullable();
            $table->string('lancard')->nullable();
            $table->string('vgacard')->nullable();
            $table->string('mouse')->nullable();
            $table->string('keyboard')->nullable();
            $table->string('os');
            $table->string('antivirus')->nullable();
            $table->string('office');
            $table->string('ip')->nullable();
            $table->string('user')->nullable();
            $table->string('bagian');
            $table->string('departemenid');
            $table->date('expantivirus')->nullable();
            $table->date('tanggalmasuk');
            $table->date('tanggalkeluar')->nullable();
            $table->integer('harga')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('kelompok');
            $table->string('stocknumber')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komputer');
    }
};
