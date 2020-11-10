<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
    
//Auth::routes();

Route::match(['post','get'],'/login', 'DashboardController@login')->name('login');
Route::match(['post','get'],'/logout', function(){
    Session::forget('current_user_id');
    return redirect()->route('welcome');
});

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    