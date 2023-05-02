<?php

use App\Models\Doc;
use App\Models\Folder;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

    Route::get('/dashboard',function(){
        return view('dashboard');
    })->name('dashboard');
    
});

// User logged in and is admin
Route::middleware('perms:admin')->group(function(){

});