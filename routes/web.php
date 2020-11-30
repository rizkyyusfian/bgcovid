<?php

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
});

//ROUTE CONTROLLER
Route::resource('/kabupaten', 'KabupatenController');

//ROUTE LAYOUT TEMPLATE
Route::get('/layouts', function() {
    return view('layouts.conquer');
});


//ROUTE AUTH
Auth::routes();


//ROUTE HOME->LOGIN REGISTER
Route::get('/home', 'HomeController@index')->name('home');
