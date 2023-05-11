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
        Schema::create('ativosnaocorrentes', function (Blueprint $table) {
            $table->id('ativonaocorrente_id');
            $table->decimal('ativonaocorrente_ativofixo', 15, 2);
            $table->decimal('ativonaocorrente_goodwill', 15, 2);
            $table->decimal('ativonaocorrente_ativointangivel', 15, 2);
            $table->decimal('ativonaocorrente_outros', 15, 2);
            
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
        Schema::dropIfExists('ativosnaocorrentes');
    }
};
