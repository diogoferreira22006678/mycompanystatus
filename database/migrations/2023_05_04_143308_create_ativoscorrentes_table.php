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
        Schema::create('ativoscorrentes', function (Blueprint $table) {
            $table->id('ativoscorrente_id');

            // belongsTo Ativo
            $table->unsignedBigInteger('ativo_id');
            $table->foreign('ativo_id')->references('ativo_id')->on('ativos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ativoscorrentes');
    }
};
