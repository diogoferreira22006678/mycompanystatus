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
            $table->decimal('ativoscorrentes_inventarios', 15, 2);
            $table->decimal('ativoscorrentes_clientes', 15, 2);
            $table->decimal('ativoscorrentes_adiantamentosafornecedores', 15, 2);
            $table->decimal('ativoscorrentes_estadoeoutrosentespublicos', 15, 2);
            $table->decimal('ativoscorrentes_outrascontasareceber', 15, 2);
            $table->decimal('ativoscorrentes_diferimentos', 15, 2);
            $table->decimal('ativoscorrentes_outrosativoscorrentes', 15, 2);
            $table->decimal('ativoscorrentes_caixaedepositosbancarios', 15, 2);

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
