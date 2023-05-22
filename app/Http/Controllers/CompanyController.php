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
        
        

        return view('dashboard', 
        [
        'company' => $company,
        'user' => $user,
        'report' => $report
        ]);
    }
}
