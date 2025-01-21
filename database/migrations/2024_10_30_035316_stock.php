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
        Schema::create('stock', function (Blueprint $table) {

            $table->id();
            $table->string('cabangid');
            $table->string('departemenid');
            $table->string('jenisid');
            $table->date('tanggalbeli');
            $table->string('nomorurut');
            $table->string('diperiksaoleh');
            $table->date('tanggalperiksa');
            $table->string('stocknumber')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
