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
Route::post('/create/users', 'DocsController@usersCreate')->name('users.createUsers');

//Route to update Users
Route::post('/update/users', 'DocsController@usersUpdate')->name('users.editUsers');

//Route to delete Users
Route::post('/delete/users', 'DocsController@usersDelete')->name('users.deleteUsers');



