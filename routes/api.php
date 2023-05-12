<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*-----------------------------------Users-----------------------------------*/

//Route to get all users using TableController_api
Route::post('/table/users', 'TableController_api@users');

//Route to select a user using SelectController_api
Route::get('/select/users', 'SelectController_api@users');

//Route to create Users
Route::post('/create/users', 'LoginController@usersCreate')->name('users.createUsers');

//Route to update Users
Route::post('/update/users', 'LoginController@usersUpdate')->name('users.editUsers');

//Route to delete Users
Route::post('/delete/users', 'LoginController@usersDelete')->name('users.deleteUsers');

// Route to alter user photo
Route::post('/alterPhoto/users', 'LoginController@usersAlterPhoto')->name('users.alterPhoto');

// Route to get user photo
Route::get('/getPhoto/users', 'LoginController@usersGetPhoto')->name('users.getPhoto');

// Route to alter settings
Route::post('/alterSettings/users', 'LoginController@usersAlterSettings')->name('users.alterSettings');

/*----------------------------Company---------------------------------------------------*/

// Route to get all the companies of a user using TableController_api
Route::post('/table/companies/{id}', 'TableController_api@companies');

// Route to select a sector using SelectController_api
Route::get('/select/sectors', 'SelectController_api@sectors');

//Route to select a company using SelectController_api
Route::get('/select/companies', 'SelectController_api@companies');

//Route to get a company
Route::get('/get/companies', 'CompanyController@companiesGet')->name('companies.getCompany');

// Route to create Companies
Route::post('/create/companies', 'CompanyController@companiesCreate')->name('companies.createCompanies');

// Route to update Companies
Route::post('/update/companies', 'CompanyController@companiesUpdate')->name('companies.editCompanies');

// Route to delete Companies
Route::post('/delete/companies', 'CompanyController@companiesDelete')->name('companies.deleteCompanies');

Route::get('/index/reports', 'CompanyController@reportsGet')->name('companies.getCompanyReports');

/*-------------------------------Reports-----------------------------------------------*/

// Route to get all the reports of a company using TableController_api
Route::post('/table/reports/{id}', 'TableController_api@reports');

// Route to select a report using SelectController_api
Route::get('/select/reports', 'SelectController_api@reports');

// Route to create Reports
Route::post('/create/reports', 'ReportController@reportsCreate')->name('reports.createReports');

// Route to delete Reports
Route::post('/delete/reports', 'ReportController@reportsDelete')->name('reports.deleteReports');

// Route to get a excel 
Route::get('/get/excel', 'ReportController@reportsGetExcel')->name('download-excel');
