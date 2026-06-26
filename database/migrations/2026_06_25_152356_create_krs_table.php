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
        Schema::create('krs', function (Blueprint $table) {
            $table->id(); // int.10 unsigned auto-increment
            $table->string('npm', 10);
            $table->string('kode_matakuliah', 8);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('npm')->references('npm')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('kode_matakuliah')->references('kode_matakuliah')->on('matakuliahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
