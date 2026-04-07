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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kandidat_id');
            $table->unsignedBigInteger('kriteria_id');
            $table->float('nilai');
            
            $table->foreign('kandidat_id')->references('id')->on('kandidat')->onDelete('cascade');
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->onDelete('cascade');
            $table->unique(['kandidat_id', 'kriteria_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
