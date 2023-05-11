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
        Schema::create('capitaisproprios', function (Blueprint $table) {
            $table->id('capitaisproprios_id');
            $table->decimal('capitaisproprios_capitalrealizado', 15, 2);
            $table->decimal('capitaisproprios_outrosinstrumentoscapitalproprio', 15, 2);
            $table->decimal('capitaisproprios_reservaslegais', 15, 2);
            $table->decimal('capitaisproprios_resultadostransitados', 15, 2);
            $table->decimal('capitaisproprios_outrasvariacoescapitalproprio', 15, 2);

            // belongsTo Balanco
            $table->unsignedBigInteger('balanco_id');
            $table->foreign('balanco_id')->references('balanco_id')->on('balancos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capitaisproprios');
    }
};
