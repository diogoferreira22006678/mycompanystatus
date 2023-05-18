<?php

namespace App\Http\Controllers;

use Excel;
use App\Models\Ativo;
use App\Models\AtivoCorrente;
use App\Models\AtivoNaoCorrente;
use App\Models\Report;
use App\Models\Balance;
use App\Models\Passivo;
use App\Models\Resultado;
use Illuminate\Http\Request;
use App\Models\CapitalProprio;
use App\Models\PassivoCorrente;
use App\Models\PassivoNaoCorrente;
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
        $data['resultado_ganhos_perdas_imputados'] = $sheet->getCell('B10')->getValue();
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
        $data['resultado_antes_depreciacoes'] = $sheet->getCell('B24')->getCalculatedValue();
        $data['resultado_gastos_reversoes_depreciacoes'] = $sheet->getCell('B25')->getValue();
        $data['resultado_imparidade_investimentos_depreciaveis'] = $sheet->getCell('B26')->getValue();
        $data['resultado_operacional_antes_gastos'] = $sheet->getCell('B27')->getCalculatedValue();
        $data['resultado_juros_rendimentos_similares'] = $sheet->getCell('B28')->getValue();
        $data['resultado_juros_gastos_similares'] = $sheet->getCell('B29')->getValue();
        $data['resultado_antes_impostos'] = $sheet->getCell('B30')->getCalculatedValue();
        $data['resultado_imposto_rendimento'] = $sheet->getCell('B31')->getValue();
        $data['resultado_liquido'] = $sheet->getCell('B32')->getCalculatedValue();
        

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

        $report = new Report();

        $report->report_year = $report_year;
        $report->company_id = $request->company_id;

        $report->save();

        $resultado = new Resultado();

        $resultado->report_id = $report->report_id;
        $resultado->resultado_vsp = $data['resultado_vsp'];
        $resultado->resultado_sub_exp = $data['resultado_sub_exp'];
        $resultado->resultado_ganhos_perdas_imputados = $data['resultado_ganhos_perdas_imputados'];
        $resultado->resultado_variacao_inventarios_producao = $data['resultado_variacao_inventarios_producao'];
        $resultado->resultado_trabalhos_proprios = $data['resultado_trabalhos_proprios'];
        $resultado->resultado_custo_mercadorias_vendidas = $data['resultado_custo_mercadorias_vendidas'];
        $resultado->resultado_fornecimentos_servicos_externos = $data['resultado_fornecimentos_servicos_externos'];
        $resultado->resultado_gastos_pessoal = $data['resultado_gastos_pessoal'];
        $resultado->resultado_imparidade_inventarios = $data['resultado_imparidade_inventarios'];
        $resultado->resultado_imparidade_dividas_receber = $data['resultado_imparidade_dividas_receber'];
        $resultado->resultado_provisoes = $data['resultado_provisoes'];
        $resultado->resultado_imparidade_investimentos = $data['resultado_imparidade_investimentos'];
        $resultado->resultado_outras_imparidades = $data['resultado_outras_imparidades'];
        $resultado->resultado_aumento_reducoes_justo_valor = $data['resultado_aumento_reducoes_justo_valor'];
        $resultado->resultado_outros_rendimentos_ganhos = $data['resultado_outros_rendimentos_ganhos'];
        $resultado->resultado_outros_gastos_perdas = $data['resultado_outros_gastos_perdas'];
        $resultado->resultado_antes_depreciacoes = $data['resultado_antes_depreciacoes'];
        $resultado->resultado_gastos_reversoes_depreciacoes = $data['resultado_gastos_reversoes_depreciacoes'];
        $resultado->resultado_imparidade_investimentos_depreciaveis = $data['resultado_imparidade_investimentos_depreciaveis'];
        $resultado->resultado_operacional_antes_gastos = $data['resultado_operacional_antes_gastos'];
        $resultado->resultado_juros_rendimentos_similares = $data['resultado_juros_rendimentos_similares'];
        $resultado->resultado_juros_gastos_similares = $data['resultado_juros_gastos_similares'];
        $resultado->resultado_antes_impostos = $data['resultado_antes_impostos'];
        $resultado->resultado_imposto_rendimento = $data['resultado_imposto_rendimento'];
        $resultado->resultado_liquido = $data['resultado_liquido'];

        $resultado->save();

        $balance = new Balance();

        $balance->report_id = $report->report_id;

        $balance->save();

        $ativo = new Ativo();

        $ativo->balanco_id = $balance->balanco_id;

        $ativo->save();

        $passivo = new Passivo();

        $passivo->balanco_id = $balance->balanco_id;

        $passivo->save();

        $capitalproprio = new CapitalProprio();

        $capitalproprio->balanco_id = $balance->balanco_id;
        $capitalproprio->capitaisproprios_capitalrealizado = $data['capitaisproprios_capitalrealizado'];
        $capitalproprio->capitaisproprios_outrosinstrumentoscapitalproprio = $data['capitaisproprios_outrosinstrumentoscapitalproprio'];
        $capitalproprio->capitaisproprios_reservaslegais = $data['capitaisproprios_reservaslegais'];
        $capitalproprio->capitaisproprios_resultadostransitados = $data['capitaisproprios_resultadostransitados'];
        $capitalproprio->capitaisproprios_outrasvariacoescapitalproprio = $data['capitaisproprios_outrasvariacoescapitalproprio'];

        $capitalproprio->save();

        $passivocorrente = new PassivoCorrente();

        $passivocorrente->passivo_id = $passivo->passivo_id;
        $passivocorrente->passivoscorrentes_fornecedores = $data['passivoscorrentes_fornecedores'];
        $passivocorrente->passivoscorrentes_estadoeoutrosentespublicos = $data['passivoscorrentes_estadoeoutrosentespublicos'];
        $passivocorrente->passivoscorrentes_accionistas_socios = $data['passivoscorrentes_accionistas_socios'];
        $passivocorrente->passivoscorrentes_financiamentosobtidos = $data['passivoscorrentes_financiamentosobtidos'];
        $passivocorrente->passivoscorrentes_outrascontasapagar = $data['passivoscorrentes_outrascontasapagar'];
        $passivocorrente->passivoscorrentes_outros = $data['passivoscorrentes_outros'];

        $passivocorrente->save();

        $passivonaocorrente = new PassivoNaoCorrente();

        $passivonaocorrente->passivo_id = $passivo->passivo_id;
        $passivonaocorrente->passivosnaocorrentes_provisoes = $data['passivosnaocorrentes_provisoes'];
        $passivonaocorrente->passivosnaocorrentes_financiamentosobtidos = $data['passivosnaocorrentes_financiamentosobtidos'];
        $passivonaocorrente->passivosnaocorrentes_outros = $data['passivosnaocorrentes_outros'];

        $passivonaocorrente->save();

        $ativocorrente = new AtivoCorrente();

        $ativocorrente->ativo_id = $ativo->ativo_id;
        $ativocorrente->ativoscorrentes_inventarios = $data['ativoscorrentes_inventarios'];
        $ativocorrente->ativoscorrentes_clientes = $data['ativoscorrentes_clientes'];
        $ativocorrente->ativoscorrentes_adiantamentosafornecedores = $data['ativoscorrentes_adiantamentosafornecedores'];
        $ativocorrente->ativoscorrentes_estadoeoutrosentespublicos = $data['ativoscorrentes_estadoeoutrosentespublicos'];
        $ativocorrente->ativoscorrentes_outrascontasareceber = $data['ativoscorrentes_outrascontasareceber'];
        $ativocorrente->ativoscorrentes_diferimentos = $data['ativoscorrentes_diferimentos'];
        $ativocorrente->ativoscorrentes_outrosativoscorrentes = $data['ativoscorrentes_outrosativoscorrentes'];
        $ativocorrente->ativoscorrentes_caixaedepositosbancarios = $data['ativoscorrentes_caixaedepositosbancarios'];

        $ativocorrente->save();

        $ativonaocorrente = new AtivoNaoCorrente();

        $ativonaocorrente->ativo_id = $ativo->ativo_id;
        $ativonaocorrente->ativonaocorrente_ativofixo = $data['ativonaocorrente_ativofixo'];
        $ativonaocorrente->ativonaocorrente_goodwill = $data['ativonaocorrente_goodwill'];
        $ativonaocorrente->ativonaocorrente_ativointangivel = $data['ativonaocorrente_ativointangivel'];
        $ativonaocorrente->ativonaocorrente_outros = $data['ativonaocorrente_outros'];

        $ativonaocorrente->save();

        return response()->json([
            "message" => "report record created"
        ], 201);

    }

    public function reportsDelete(Request $request){

        $report_id = $request->report_id;

        Report::where('report_id', $report_id)->delete();

        // Get Balance where report_id = $report_id
        $balanco_id = Balance::where('report_id', $report_id)->first()->pluck('balanco_id');
        $ativo_id = Ativo::where('balanco_id', $balanco_id)->first()->pluck('ativo_id');
        $passivo_id = Passivo::where('balanco_id', $balanco_id)->first()->pluck('passivo_id');

        Ativo::whereIn('balanco_id', $balanco_id)->delete();

        Passivo::whereIn('balanco_id', $balanco_id)->delete();

        CapitalProprio::whereIn('balanco_id', $balanco_id)->delete();        

        Balance::where('report_id', $report_id)->delete();

        Resultado::where('report_id', $report_id)->delete();

        PassivoCorrente::whereIn('passivo_id', $passivo_id)->delete();

        PassivoNaoCorrente::whereIn('passivo_id', $passivo_id)->delete();

        AtivoCorrente::whereIn('ativo_id', $ativo_id)->delete();

        AtivoNaoCorrente::whereIn('ativo_id', $ativo_id)->delete();
    

        return response()->json([
            "message" => "report record deleted"
        ], 201);

    }
}
