<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\Ativo;
use App\Models\AtivoCorrente;
use App\Models\Report;
use App\Models\Balance;
use App\Models\Passivo;
use App\Models\Resultado;
use Illuminate\Http\Request;
use App\Models\CapitalProprio;
use App\Models\PassivoCorrente;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ReportController extends Controller
{
    public function reportsGetExcel(){

        $file = Storage::disk('local')->get('public/My_Company_Status_Template.xls');

        // Make the user download the excel file
        return response()->download(storage_path('app/public/My_Company_Status_Template.xls'));
    }

    public function reportsCreate(Request $request){

        $excel = $request->file('file');

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load($excel);
        $sheet = $spreadsheet->getActiveSheet();

        $data = [];
        $report_year = $request->report_year;
        // RESULTADO
        $data['resultado_vsp'] = $sheet->getCell('B8')->getValue();
        $data['resultado_sub_exp'] = $sheet->getCell('B9')->getValue();
        $data['resultado_ganhos_perdas_imputados '] = $sheet->getCell('B10')->getValue();
        $data['resultado_variacao_inventarios_producao'] = $sheet->getCell('B11')->getValue();
        $data['resultado_trabalhos_proprios'] = $sheet->getCell('B12')->getValue();
        $data['resultado_custo_mercadorias_vendidas'] = $sheet->getCell('B13')->getValue();
        $data['resultado_fornecimentos_servicos_externos'] = $sheet->getCell('B14')->getValue();
        $data['resultado_gastos_pessoal'] = $sheet->getCell('B15')->getValue();
        $data['resultado_imparidade_inventarios'] = $sheet->getCell('B16')->getValue();
        $data['resultado_imparidade_dividas_receber'] = $sheet->getCell('B17')->getValue();
        $data['resultado_provisoes'] = $sheet->getCell('B18')->getValue();
        $data['resultado_imparidade_investimentos'] = $sheet->getCell('B19')->getValue();
        $data['resultado_outras_imparidades'] = $sheet->getCell('B20')->getValue();
        $data['resultado_aumento_reducoes_justo_valor'] = $sheet->getCell('B21')->getValue();
        $data['resultado_outros_rendimentos_ganhos'] = $sheet->getCell('B22')->getValue();
        $data['resultado_outros_gastos_perdas'] = $sheet->getCell('B23')->getValue();
        $data['resultado_antes_depreciacoes'] = $sheet->getCell('B24')->getValue();
        $data['resultado_gastos_reversoes_depreciacoes'] = $sheet->getCell('B25')->getValue();
        $data['resultado_imparidade_investimentos_depreciaveis'] = $sheet->getCell('B26')->getValue();
        $data['resultado_operacional_antes_gastos'] = $sheet->getCell('B27')->getValue();
        $data['resultado_juros_rendimentos_similares'] = $sheet->getCell('B28')->getValue();
        $data['resultado_juros_gastos_similares'] = $sheet->getCell('B29')->getValue();
        $data['resultado_antes_impostos'] = $sheet->getCell('B30')->getValue();
        $data['resultado_imposto_rendimento'] = $sheet->getCell('B31')->getValue();
        $data['resultado_liquido'] = $sheet->getCell('B32')->getValue();
        

        // BALANÇO

        // Ativo

        // Ativo Não Corrente

        $data['ativonaocorrente_ativofixo'] = $sheet->getCell('I9')->getValue();
        $data['ativonaocorrente_goodwill'] = $sheet->getCell('I10')->getValue();
        $data['ativonaocorrente_ativointangivel'] = $sheet->getCell('I11')->getValue();
        $data['ativonaocorrente_outros'] = $sheet->getCell('I12')->getValue();

        // Ativo Corrente

        $data['ativoscorrentes_inventarios'] = $sheet->getCell('I15')->getValue();
        $data['ativoscorrentes_clientes'] = $sheet->getCell('I16')->getValue();
        $data['ativoscorrentes_adiantamentosafornecedores'] = $sheet->getCell('I17')->getValue();
        $data['ativoscorrentes_estadoeoutrosentespublicos'] = $sheet->getCell('I18')->getValue();
        $data['ativoscorrentes_outrascontasareceber'] = $sheet->getCell('I19')->getValue();
        $data['ativoscorrentes_diferimentos'] = $sheet->getCell('I20')->getValue();
        $data['ativoscorrentes_outrosativoscorrentes'] = $sheet->getCell('I21')->getValue();
        $data['ativoscorrentes_caixaedepositosbancarios'] = $sheet->getCell('I22')->getValue();

        // Capital Próprio

        $data['capitaisproprios_capitalrealizado'] = $sheet->getCell('I27')->getValue();
        $data['capitaisproprios_outrosinstrumentoscapitalproprio'] = $sheet->getCell('I28')->getValue();
        $data['capitaisproprios_reservaslegais'] = $sheet->getCell('I29')->getValue();
        $data['capitaisproprios_resultadostransitados'] = $sheet->getCell('I30')->getValue();
        $data['capitaisproprios_outrasvariacoescapitalproprio'] = $sheet->getCell('I31')->getValue();

        // Passivo

        // Passivo Não Corrente

        $data['passivosnaocorrentes_provisoes'] = $sheet->getCell('I37')->getValue();
        $data['passivosnaocorrentes_financiamentosobtidos'] = $sheet->getCell('I38')->getValue();
        $data['passivosnaocorrentes_outros'] = $sheet->getCell('I39')->getValue();

        // Passivo Corrente

        $data['passivoscorrentes_fornecedores'] = $sheet->getCell('I42')->getValue();
        $data['passivoscorrentes_estadoeoutrosentespublicos'] = $sheet->getCell('I43')->getValue();
        $data['passivoscorrentes_accionistas_socios'] = $sheet->getCell('I44')->getValue();
        $data['passivoscorrentes_financiamentosobtidos'] = $sheet->getCell('I45')->getValue();
        $data['passivoscorrentes_outrascontasapagar'] = $sheet->getCell('I46')->getValue();
        $data['passivoscorrentes_outros'] = $sheet->getCell('I47')->getValue();

        dd($data);
    }

    public function reportsDelete(Request $request){

        $report_id = $request->report_id;

        Report::where('report_id', $report_id)->delete();

        // Get Balance where report_id = $report_id
        $balance_id = Balance::where('report_id', $report_id)->pluck('balance_id');
        $ativo_id = Balance::where('balance_id', $balance_id)->pluck('ativo_id');
        $passivo_id = Balance::where('balance_id', $balance_id)->pluck('passivo_id');

        Ativo::whereIn('balanco_id', $balance_id)->delete();

        Passivo::whereIn('balanco_id', $balance_id)->delete();

        CapitalProprio::whereIn('balanco_id', $balance_id)->delete();        

        Balance::where('report_id', $report_id)->delete();

        Resultado::where('report_id', $report_id)->delete();

        PassivoCorrente::whereIn('balanco_id', $balance_id)->delete();

        AtivoCorrente::whereIn('balanco_id', $balance_id)->delete();

        return response()->json([
            "message" => "report record deleted"
        ], 201);

    }
}
