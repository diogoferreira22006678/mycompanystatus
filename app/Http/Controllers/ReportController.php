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

class ReportController extends Controller
{
    public function reportsGetExcel(){

        $file = Storage::disk('local')->get('public/My_Company_Status_Template.xls');

        // Make the user download the excel file
        return response()->download(storage_path('app/public/My_Company_Status_Template.xls'));
    }

    public function reportsCreate(Request $request){

        $excel = $request->file('file');

        $data = \Excel::load($excel, function($reader) {})->get();


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
