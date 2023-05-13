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
        Schema::create('passivoscorrentes', function (Blueprint $table) {
            $table->id('passivoscorrente_id');
            $table->decimal('passivoscorrentes_fornecedores', 15, 2);
            $table->decimal('passivoscorrentes_estadoeoutrosentespublicos', 15, 2);
            $table->decimal('passivoscorrentes_accionistas_socios', 15, 2);
            $table->decimal('passivoscorrentes_financiamentosobtidos', 15, 2);   
            $table->decimal('passivoscorrentes_outrascontasapagar', 15, 2);
            $table->decimal('passivoscorrentes_outros', 15, 2);

            // belongsTo Passivo
            $table->unsignedBigInteger('passivo_id');
            $table->foreign('passivo_id')->references('passivo_id')->on('passivos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passivoscorrentes');
    }
};
