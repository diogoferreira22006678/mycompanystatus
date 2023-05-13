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
        Schema::create('resultados', function (Blueprint $table) {
            $table->id('resultado_id');
            $table->decimal('resultado_vsp', 15, 2);
            $table->decimal('resultado_sub_exp', 15, 2);
            $table->decimal('resultado_ganhos_perdas_imputados', 15, 2);
            $table->decimal('resultado_variacao_inventarios_producao', 15, 2);
            $table->decimal('resultado_trabalhos_proprios', 15, 2);
            $table->decimal('resultado_custo_mercadorias_vendidas', 15, 2);
            $table->decimal('resultado_fornecimentos_servicos_externos', 15, 2);
            $table->decimal('resultado_gastos_pessoal', 15, 2);
            $table->decimal('resultado_imparidade_inventarios', 15, 2);
            $table->decimal('resultado_imparidade_dividas_receber', 15, 2);
            $table->decimal('resultado_provisoes', 15, 2);
            $table->decimal('resultado_imparidade_investimentos', 15, 2);
            $table->decimal('resultado_outras_imparidades', 15, 2);
            $table->decimal('resultado_aumento_reducoes_justo_valor', 15, 2);
            $table->decimal('resultado_outros_rendimentos_ganhos', 15, 2);
            $table->decimal('resultado_outros_gastos_perdas', 15, 2);
            $table->decimal('resultado_antes_depreciacoes', 15, 2);
            $table->decimal('resultado_gastos_reversoes_depreciacoes', 15, 2);
            $table->decimal('resultado_imparidade_investimentos_depreciaveis', 15, 2);
            $table->decimal('resultado_operacional_antes_gastos', 15, 2);
            $table->decimal('resultado_juros_rendimentos_similares', 15, 2);
            $table->decimal('resultado_juros_gastos_similares', 15, 2);
            $table->decimal('resultado_antes_impostos', 15, 2);
            $table->decimal('resultado_imposto_rendimento', 15, 2);
            $table->decimal('resultado_liquido', 15, 2);
                            
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
        Schema::dropIfExists('resultados');
    }
};
