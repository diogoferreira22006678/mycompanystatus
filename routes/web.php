<?php

use App\Models\Doc;
use App\Models\User;
use App\Models\Folder;
use App\Models\Sector;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\EconomicSectorController;
use App\Models\Company;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/economic-sectors', [EconomicSectorController::class, 'getEconomicSectors']);
/*-----------------------------------Login-----------------------------------*/

Route::post('/login', 'LoginController@login')->name('login');

Route::post('/logout', 'LoginController@logout')->name('logout');

Route::post('/register', 'LoginController@register')->name('register');

Route::get('/login', function () {
    return view('login');
}) -> name('loginPage');

Route::get('/register', function () {
    return view('register');
}) -> name('registerPage');

// User logged in
Route::middleware('perms')->group(function(){

    Route::get('/', function(){
        return view('homepage');
    })->name('homePage');

    Route::get('/dashboard',function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('profile', function(){
        return view('profile');
    })->name('profile');

    Route::get('companies', function(){
        return view('companies');
    })->name('companies');

    Route::get('/reports/{company_id?}', function($company_id){

        if($company_id == 0){
            // Get the first company of the user
            $company = Company::where('user_id', User::getCurrent()->user_id)->first();
        }else{
            $company = Company::find($company_id);
        }

        return view('reports', [
            'company_id' => $company_id,
            'company_name' => $company->company_name
        ]);
    })->name('reports');
    

    Route::get('publicReports', function(){
        return view('publicReports');
    })->name('publicReports');

});

// User logged in and is admin
Route::middleware('perms:admin')->group(function(){

});