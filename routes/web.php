<?php

use App\Models\User;
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

    Route::get('profile', function(){
        return view('profile');
    })->name('profile');

    Route::get('companies', function(){
        return view('companies');
    })->name('companies');

    Route::get('/reports', function(){

        $user = User::getCurrent();

        return view('noCompanies', ['user' => $user]);

    })->name('reports');

    Route::get('/{id_company}/reports', 'CompanyController@getCompany');

    Route::get('/dashboard/{id_company}/reports/{report_id}', 'CompanyController@getDashboardCompany');
    
    Route::get('/reports/public', function(){
        return view('publicReports');
    })->name('publicReports');

});

