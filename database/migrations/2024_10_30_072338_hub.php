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
        Schema::create('hub', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->string('user')->nullable();
            $table->string('bagian');
            $table->string('departemenid');
            $table->date('tanggalmasuk');
            $table->date('tanggalkeluar')->nullable();
            $table->integer('harga')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('kelompok');
            $table->string('stocknumber')->unique();
            $table->string('jenisid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hub');
    }
};
