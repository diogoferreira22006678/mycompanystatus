<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function companiesCreate(Request $request)
    {
        // Create a new company
        $company = new Company;
        $company->company_name = $request->name;
        $company->company_email = $request->email;
        $company->company_phone = $request->phone;
        $company->company_website = $request->website;
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
}
