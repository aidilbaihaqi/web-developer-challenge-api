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
        Schema::create('basis_evaluasis', function (Blueprint $table) {
            $table->string('kodeEvaluasi')->primary();
            $table->string('kodeRPS');
            $table->string('namaEvaluasi');
            $table->integer('bobotEvaluasi');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basis_evaluasis');
    }
};
