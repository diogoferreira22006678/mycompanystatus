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

    Route::get('/reports', function(){
        $user_id = request('user_id');
        $company_id = request('company_id');
        
        if(User::getCurrent()->user_id != $user_id){
            return view('noCompanies');
        }

        // if company_id is null go get the first company of the user
        if($company_id == null){
            // See if the user has any companies
            $companies = \DB::table('companies')->where('user_id', $user_id)->get();
            // if the user has no companies return to the view no companies
            if($companies->isEmpty()){
                return view('noCompanies');
            }else{
                // if the user has companies get the first company
                $company_id = $companies[0]->company_id;
            }
        }
        
        return view('reports', [
            'user_id' => $user_id,
            'company_id' => $company_id
        ]);
    })->name('reports');
    

    Route::get('publicReports', function(){
        return view('publicReports');
    })->name('publicReports');

});

// User logged in and is admin
Route::middleware('perms:admin')->group(function(){

});