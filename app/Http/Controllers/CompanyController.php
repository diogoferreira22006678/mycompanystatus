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
   
}
