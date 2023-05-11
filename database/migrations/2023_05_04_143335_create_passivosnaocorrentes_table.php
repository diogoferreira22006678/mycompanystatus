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
        Schema::create('passivosnaocorrentes', function (Blueprint $table) {
            $table->id('passivosnaocorrente_id');
            $table->decimal('passivosnaocorrentes_provisoes', 15, 2);
            $table->decimal('passivosnaocorrentes_financiamentosobtidos', 15, 2);
            $table->decimal('passivosnaocorrentes_outros', 15, 2);


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
        Schema::dropIfExists('passivosnaocorrentes');
    }
};
