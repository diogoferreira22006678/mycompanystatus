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
        $reportFromYearBefore = Report::where('company_id', $id_company)->where('report_year', $year-1)->first();

        $total_capital_proprio = $capital_proprio->capitaisproprios_capitalrealizado + $capital_proprio->capitaisproprios_outrosinstrumentoscapitalproprio + $capital_proprio->capitaisproprios_reservaslegais + $capital_proprio->capital_proprio_resultados_transitados + $capital_proprio->capitaisproprios_resultadostransitados + $capital_proprio->capitaisproprios_outrasvariacoescapitalproprio;
        $total_passivo_corrente = $passivo_corrente->passivoscorrentes_fornecedores + $passivo_corrente->passivoscorrentes_estadoeoutrosentespublicos + $passivo_corrente->passivoscorrentes_accionistas_socios + $passivo_corrente->passivoscorrentes_financiamentosobtidos + $passivo_corrente->passivoscorrentes_outrascontasapagar + $passivo_corrente->passivoscorrentes_outros;

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

        // get balance from year before
        $reportFromYearBefore = Report::where('report_year', $year-1)->first();
        $balanceFromYearBefore = Balance::where('report_id', $reportFromYearBefore->report_id)->first();
        $ativoFromYearBefore = Ativo::where('balanco_id', $balanceFromYearBefore->balanco_id)->first();
        // ativo corrente
        $ativoCorrenteFromYearBefore = AtivoCorrente::where('ativo_id', $ativoFromYearBefore->ativo_id)->first();
        $compras = $result->resultado_custo_mercadorias_vendidas + 
        $ativo_corrente->ativoscorrentes_inventarios - $ativoCorrenteFromYearBefore->ativoscorrentes_inventarios;

        /***************************************************************************************************************/

        // Ratio liquidez geral = ativo corrente/passivo corrente
        $ratio_liquidez_geral = $total_ativo_corrente / $total_passivo_corrente * 100;
        $ratio_liquidez_geral = round($ratio_liquidez_geral, 2) . '%';

        // Ratio liquidez reduzida = (ativo corrente - inventários - act.biologicos) / passivo corrente
        $ratio_liquidez_reduzida = ($total_ativo_corrente - $ativo_corrente->ativoscorrentes_inventarios - $ativo_corrente->ativoscorrentes_activosbiologicos) / $total_passivo_corrente * 100;
        $ratio_liquidez_reduzida = round($ratio_liquidez_reduzida, 2) . '%';

        // Ratio autonomia financeira = capital proprio /  ativo total
        $ratio_autonomia_financeira = $total_capital_proprio / ($total_ativo_corrente + $total_ativo_nao_corrente) * 100;
        $ratio_autonomia_financeira = round($ratio_autonomia_financeira, 2);

        // Endividamento = passivo total / ativo total
        $ratio_endividamento = (($total_passivo_corrente + $total_passivo_nao_corrente) / ($total_ativo_corrente + $total_ativo_nao_corrente)) * 100;
        $ratio_endividamento = round($ratio_endividamento, 2);

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
        $ratio_prazo_medio_pagamento = ($passivo_corrente->passivoscorrentes_fornecedores) / ((($compras + $result->resultado_variacao_inventarios_producao) * 1.23) / 365);
        $ratio_prazo_medio_pagamento = round($ratio_prazo_medio_pagamento, 2) . ' dias';

        // Rotacao do ativo = VSP / ativo total
        $ratio_rotacao_do_ativo = $result->resultado_vsp / ($total_ativo_corrente + $total_ativo_nao_corrente);
        $ratio_rotacao_do_ativo = round($ratio_rotacao_do_ativo, 2) . ' Vezes';

        // Producao = VSP + SE + VIP + TPE + RS
        $producao = $result->resultado_vsp + $result->resultado_sub_exp + $result->resultado_outros_rendimentos_ganhos;
        $producao = round($producao, 2);

        // CI = CMVMC + FSE + Impostos indirectos 
        $ci = $result->resultado_custo_mercadorias_vendidas + $result->resultado_fornecimentos_servicos_externos;
        $ci = round($ci, 2);

        // VAB = Producao - CI
        $vab = $producao - $ci;
        $vab = round($vab, 2);

        // Coeficiente Vab = VAB / Gastos Pessoais
        $ratio_coeficiente_vab = $vab / $result->resultado_gastos_pessoal;
        $ratio_coeficiente_vab = round($ratio_coeficiente_vab, 2);

        // Rentabilidade do ativo = EBITDA / Ativo total
        $ratio_rentabilidade_do_ativo = $result->resultado_antes_depreciacoes / ($total_ativo_corrente + $total_ativo_nao_corrente) * 100;
        $ratio_rentabilidade_do_ativo = round($ratio_rentabilidade_do_ativo, 2);

        $ratio_rentabilidade_do_ativo_liquido = $result->resultado_liquido / ($total_ativo_corrente + $total_ativo_nao_corrente) * 100;
        $ratio_rentabilidade_do_ativo_liquido = round($ratio_rentabilidade_do_ativo_liquido, 2);

        // Rentabilidade vendas operacionais = EBIT / Vendas e serviços prestados

        $ratio_rentabilidade_vendas_operacionais = $result->resultado_antes_depreciacoes / $result->resultado_vsp * 100;
        $ratio_rentabilidade_vendas_operacionais = round($ratio_rentabilidade_vendas_operacionais, 2);

        // Rentabilidade do liquida = Resultado liquido / Vendas e serviços prestados
        $ratio_rentabilidade_liquida = $result->resultado_liquido / $result->resultado_vsp * 100;
        $ratio_rentabilidade_liquida = round($ratio_rentabilidade_liquida, 2);

        // ROE = Resultado liquido / Capital proprio 
        $ratio_roe = $result->resultado_liquido / $total_capital_proprio * 100;
        $ratio_roe = round($ratio_roe, 2);

        // Alavanca financeira = Ativo total / Capital proprio
        $ratio_alavanca_financeira = ($total_ativo_corrente + $total_ativo_nao_corrente) / $total_capital_proprio;
        $ratio_alavanca_financeira = round($ratio_alavanca_financeira, 2);

        return view('dashboard', 
        [
        'company' => $company,
        'user' => $user,
        'report' => $report,
        'ratio_liquidez_geral' => $ratio_liquidez_geral,
        'ratio_liquidez_reduzida' => $ratio_liquidez_reduzida,
        'ratio_autonomia_financeira' => $ratio_autonomia_financeira,
        'ratio_endividamento' => $ratio_endividamento,
        'ratio_solvabilidade' => $ratio_solvabilidade,
        'ratio_peso_passivo_remunerado' => $ratio_peso_passivo_remunerado,
        'custos_do_financiamento_obtido' => $custos_do_financiamento_obtido,
        'ratio_pressao_financeira' => $ratio_pressao_financeira,
        'ratio_prazo_medio_recebimento' => $ratio_prazo_medio_recebimento,
        'ratio_prazo_medio_pagamento' => $ratio_prazo_medio_pagamento,
        'ratio_rotacao_do_ativo' => $ratio_rotacao_do_ativo,
        'producao' => $producao,
        'ci' => $ci,
        'vab' => $vab,
        'ratio_coeficiente_vab' => $ratio_coeficiente_vab,
        'ratio_rentabilidade_do_ativo' => $ratio_rentabilidade_do_ativo,
        'ratio_rentabilidade_do_ativo_liquido' => $ratio_rentabilidade_do_ativo_liquido,
        'ratio_rentabilidade_vendas_operacionais' => $ratio_rentabilidade_vendas_operacionais,
        'ratio_rentabilidade_liquida' => $ratio_rentabilidade_liquida,
        'ratio_roe' => $ratio_roe,
        'ratio_alavanca_financeira' => $ratio_alavanca_financeira,
        ]);
    }
}
