<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ativo;
use App\Models\AtivoCorrente;
use App\Models\AtivoNaoCorrente;
use App\Models\Report;
use App\Models\Balance;
use App\Models\Company;
use App\Models\Passivo;
use App\Models\Resultado;
use Illuminate\Http\Request;
use App\Models\CapitalProprio;
use App\Models\PassivoCorrente;
use App\Models\PassivoNaoCorrente;

class CompanyController extends Controller
{
    public function companiesCreate(Request $request)
    {
        // Create a new company
        $company = new Company;
        $company->company_name = $request->company_name;
        $company->company_email = $request->company_email;
        $company->company_phone = $request->company_phone;
        $company->company_website = $request->company_website;
        $company->user_id = $request->user_id;
        $company->sector_id = $request->sector_id;
        if($request->status == 'private'){
            $company->company_status = false;
        }else{
            $company->company_status = true;
        }
        $company->save();

        return response()->json([
            "message" => "company record created"
        ], 201);
    }

    public function companiesUpdate(Request $request){
        // Edit a company
        $company = Company::where('company_id', $request->company_id)->first();
        $company->company_name = $request->company_name;
        $company->company_email = $request->company_email;
        $company->company_phone = $request->company_phone;
        $company->company_website = $request->company_website;
        $company->sector_id = $request->sector_id;
        if($request->company_status == 'private'){
            $company->company_status = false;
        }else{
            $company->company_status = true;
        }
        $company->save();

        return response()->json([
            "message" => "company record updated"
        ], 201);
    }

    public function companiesDelete(Request $request){
        // Delete a company
        $company = Company::where('company_id', $request->company_id)->first();
        $company->delete();

        return response()->json([
            "message" => "company record deleted"
        ], 201);
    }

  
    public function getCompany($id_company){
        // Get a company
        $company = Company::where('company_id', $id_company)->first();
        $user = User::getCurrent();
        
        return view('reports', 
        [
        'company' => $company,
        'user' => $user
        ]);
    }

    public function getDashboardCompany($id_company,$year){
        // Get a company
        $company = Company::where('company_id', $id_company)->first();
        $user = User::getCurrent();
        $report = Report::where('company_id', $id_company)->where('report_year', $year)->first();
        $balance = Balance::where('report_id', $report->report_id)->first();
        $result = Resultado::where('report_id', $report->report_id)->first();
        $capital_proprio = CapitalProprio::where('balanco_id', $balance->balanco_id)->first();
        $ativo = Ativo::where('balanco_id', $balance->balanco_id)->first();
        $passivo = Passivo::where('balanco_id', $balance->balanco_id)->first();
        $ativo_corrente = AtivoCorrente::where('ativo_id', $ativo->ativo_id)->first();
        $ativo_nao_corrente = AtivoNaoCorrente::where('ativo_id', $ativo->ativo_id)->first();
        $passivo_corrente = PassivoCorrente::where('passivo_id', $passivo->passivo_id)->first();
        $passivo_nao_corrente = PassivoNaoCorrente::where('passivo_id', $passivo->passivo_id)->first();

        // Set a circular graph to see how much of the company is owned by the user and how much is owned by bank or other investors
        $total_capital_proprio = $capital_proprio->capitaisproprios_capitalrealizado + $capital_proprio->capitaisproprios_outrosinstrumentoscapitalproprio + $capital_proprio->capitaisproprios_reservaslegais + $capital_proprio->capital_proprio_resultados_transitados + $capital_proprio->capitaisproprios_resultadostransitados + $capital_proprio->capitaisproprios_outrasvariacoescapitalproprio;
        $total_passivo_corrente = $passivo_corrente->passivoscorrentes_fornecedores + $passivo_corrente->passivoscorrentes_estadoeoutrosentespublicos + $passivo_corrente->passivoscorrentes_accionistas_socios + $passivo_corrente->passivoscorrentes_financiamentosobtidos + $passivo_corrente->passivoscorrentes_outrascontasapagar + $passivo_corrente->passivoscorrentes_outros;

        // Set the percentage of the company owned by the user
        $percentage_user = ($total_capital_proprio - $total_passivo_corrente) / $total_capital_proprio * 100;
        $percentage_bank = $total_passivo_corrente / $total_capital_proprio * 100;

        // Set the graph using graph.js
        $dataPoints = array(
            array("label"=> "User", "y"=> $percentage_user),
            array("label"=> "Bank", "y"=> $percentage_bank)
        );

        $total_ativo_corrente = ( 
        $ativo_corrente->ativoscorrentes_inventarios +
        $ativo_corrente->ativoscorrentes_clientes + 
        $ativo_corrente->ativoscorrentes_adiantamentosafornecedores + 
        $ativo_corrente->ativoscorrentes_estadoeoutrosentespublicos + 
        $ativo_corrente->ativoscorrentes_outrascontasareceber + 
        $ativo_corrente->ativoscorrentes_diferimentos +
        $ativo_corrente->ativoscorrentes_outrosativoscorrentes + 
        $ativo_corrente->ativoscorrentes_caixaedepositosbancarios);

        $total_passivo_corrente = ( 
        $passivo_corrente->passivoscorrentes_fornecedores + 
        $passivo_corrente->passivoscorrentes_estadoeoutrosentespublicos + 
        $passivo_corrente->passivoscorrentes_accionistas_socios + 
        $passivo_corrente->passivoscorrentes_financiamentosobtidos + 
        $passivo_corrente->passivoscorrentes_outrascontasapagar + 
        $passivo_corrente->passivoscorrentes_outros );

        $total_capital_proprio = (
        $capital_proprio->capitaisproprios_capitalrealizado +
        $capital_proprio->capitaisproprios_outrosinstrumentoscapitalproprio +
        $capital_proprio->capitaisproprios_reservaslegais +
        $capital_proprio->capitaisproprios_resultadostransitados +
        $capital_proprio->capitaisproprios_outrasvariacoescapitalproprio + 
        $result->resultado_liquido
        );

        $total_passivo_nao_corrente = (
        $passivo_nao_corrente->passivosnaocorrentes_financiamentosobtidos +
        $passivo_nao_corrente->passivosnaocorrentes_provisoes +
        $passivo_nao_corrente->passivosnaocorrentes_outros );


        $total_ativo_nao_corrente = (
        $ativo_nao_corrente->ativonaocorrente_ativofixo +
        $ativo_nao_corrente->ativonaocorrente_goodwill +
        $ativo_nao_corrente->ativonaocorrente_ativointangivel +
        $ativo_nao_corrente->ativonaocorrente_outros );
        // Ratio liquidez geral = ativo corrente/passivo corrente
        $ratio_liquidez_geral = $total_ativo_corrente / $total_passivo_corrente * 100;
        $ratio_liquidez_geral = round($ratio_liquidez_geral, 2) . '%';

        // Ratio liquidez reduzida = (ativo corrente - inventários - act.biologicos) / passivo corrente
        $ratio_liquidez_reduzida = ($total_ativo_corrente - $ativo_corrente->ativoscorrentes_inventarios - $ativo_corrente->ativoscorrentes_activosbiologicos) / $total_passivo_corrente * 100;
        $ratio_liquidez_reduzida = round($ratio_liquidez_reduzida, 2) . '%';

        // Ratio autonomia financeira = capital proprio /  ativo total
        $ratio_autonomia_financeira = $total_capital_proprio / ($total_ativo_corrente + $total_ativo_nao_corrente) * 100;
        $ratio_autonomia_financeira = round($ratio_autonomia_financeira, 2) . '%';

        // Endividamento = passivo total / ativo total
        $ratio_endividamento = (($total_passivo_corrente + $total_passivo_nao_corrente) / ($total_ativo_corrente + $total_ativo_nao_corrente)) * 100;
        $ratio_endividamento = round($ratio_endividamento, 2) . '%';

        // Solvabilidade = capital proprio / passivo total
        $ratio_solvabilidade = $total_capital_proprio / ($total_passivo_corrente + $total_passivo_nao_corrente) * 100;
        $ratio_solvabilidade = round($ratio_solvabilidade, 2) . '%';

        // Cobertura do AnC = (capital proprio + passivo nao corrente) / activo nao corrente

        $ratio_cobertura_anc = ($total_capital_proprio + $total_passivo_nao_corrente) / $total_ativo_nao_corrente * 100;
        $ratio_cobertura_anc = round($ratio_cobertura_anc, 2) . '%';

        // Peso do passivo remunerado = (passivo corrente + passivo nao corrente) / passivo total

        $ratio_peso_passivo_remunerado = ($passivo_corrente->passivoscorrentes_financiamentosobtidos + $passivo_nao_corrente->passivosnaocorrentes_financiamentosobtidos) / ($total_passivo_corrente + $total_passivo_nao_corrente) * 100;
        $ratio_peso_passivo_remunerado = round($ratio_peso_passivo_remunerado, 2) . '%';

        // Custos dos financiamentos obtidos = resultados->juros_gastos_similares_suportados / ($passivo_corrente->passivoscorrentes_financiamentosobtidos + $passivo_nao_corrente->passivosnaocorrentes_financiamentosobtidos)
        $custos_do_financiamento_obtido = $result->resultado_juros_gastos_similares / ($passivo_corrente->passivoscorrentes_financiamentosobtidos + $passivo_nao_corrente->passivosnaocorrentes_financiamentosobtidos) * 100;
        $custos_do_financiamento_obtido = round($custos_do_financiamento_obtido, 2) . '%';
        
        // Pressão financeira = fastos de financeamento / EBITDA
        $ratio_pressao_financeira = $result->resultado_juros_gastos_similares / $result->resultado_antes_depreciacoes * 100;
        $ratio_pressao_financeira = round($ratio_pressao_financeira, 2) . '%';

        // Rácio prazo médio de recebimento = (clientes + outros devedores) / (vendas e serviços prestados + IVA / 365)
        $ratio_prazo_medio_recebimento = ($ativo_corrente->ativoscorrentes_clientes) / ((($result->resultado_vsp + $result->resultado_variacao_inventarios_producao) * 1.23) / 365);
        $ratio_prazo_medio_recebimento = round($ratio_prazo_medio_recebimento, 2) . ' dias';
        
        // Rácio prazo médio de pagamento = (fornecedores + outras contas a pagar) / (compras e serviços prestados + IVA / 365)
        $ratio_prazo_medio_pagamento = ($passivo_corrente->passivoscorrentes_fornecedores) / ((($result->re + $result->resultado_variacao_inventarios_producao) * 1.23) / 365);
        $ratio_prazo_medio_pagamento = round($ratio_prazo_medio_pagamento, 2) . ' dias';

        dd($ratio_prazo_medio_pagamento);

        return view('dashboard', 
        [
        'company' => $company,
        'user' => $user,
        'report' => $report,
        'dataPoints' => $dataPoints,
        'ratio_liquidez_geral' => $ratio_liquidez_geral
        ]);
    }
}
