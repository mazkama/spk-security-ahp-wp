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
        Schema::create('hasil_wp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kandidat_id');
            $table->foreign('kandidat_id')->references('id')->on('kandidat')->onDelete('cascade');
            $table->float('nilai_s');
            $table->float('nilai_v');
            $table->integer('ranking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_wp');
    }
};
