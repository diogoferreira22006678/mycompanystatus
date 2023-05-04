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
        Schema::create('balancos', function (Blueprint $table) {
            $table->id('balanco_id');
            

            // belongsTo Report
            $table->unsignedBigInteger('report_id');
            $table->foreign('report_id')->references('report_id')->on('reports')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balancos');
    }
};
